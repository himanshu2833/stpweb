<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiscountRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class DiscountRuleController extends Controller
{
    public function index(){
        $discountRules = DiscountRule::all();
        return view('discount-rules.index', compact('discountRules'));
    }
    public function create(){
        return view('discount-rules.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'min_qty' => 'required|integer|min:1',
            'max_qty' => 'required|integer|gt:min_qty',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'discount_type' => 'required',
            'discount_value' => 'required|numeric|min:0',
            'priority' => 'required|integer|min:1|max:5',
            'is_exclusive' => 'boolean',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        DiscountRule::create($request->all());

        return redirect()->route('discount-rules.index')->with('success', 'Discount rule created successfully.');
    }

    public function edit(DiscountRule $discountRule){
        return view('discount-rules.edit',compact('discountRule'));
    }

    public function update(Request $request, DiscountRule $discountRule){

        // validtion apply same as create

        $discountRule->update($request->all());
        return redirect()->route('discount-rules.index')->with('success', 'Discount rule updated successfully.');
    }

    public function destroy(DiscountRule $discountRule){
        $discountRule->delete();
        return redirect()->route('discount-rules.index')->with('success', 'Discount rule deleted successfully.');
    }

    public function applyDiscountForm(){
        return view('discount-rules.apply-form');
    }

    public function applyDiscount(Request $request){
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'purchase_qty' => 'required|integer|min:1',
            'purchase_date' => 'required|date',
            'purchase_amount' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $category = $request->category;
        $purchase_qty = $request->purchase_qty;
        $purchase_date = $request->purchase_date;
        $purchase_amount = $request->purchase_amount;

        $discount_rule = DiscountRule::where('category',$category)
                    ->where('min_qty','<=',$purchase_qty)
                    ->where('max_qty','>=',$purchase_qty)
                    ->where('start_date','<=',$purchase_date)
                    ->where('end_date','>=',$purchase_date)
                    ->get();

        if($discount_rule->isEmpty()){
            return redirect()->back()->with('error', 'No Discount Available');
        }
        // check exclusive
        $is_exclusive = $discount_rule->where('is_exclusive',true)->sortBy('priority')->first();

        if($is_exclusive){
            return redirect()->back()->with([
            'success' => 'Discount Available',
            'discount_match' => [
                'discount_type' => $is_exclusive->discount_type,
                'discount_value' => $is_exclusive->discount_value,
                'priority' => $is_exclusive->priority,
                'amount' => $this->calculateDiscount($is_exclusive,$purchase_amount)
            ]
            ]);
        }

        // check non exclusive
        $non_exclusive = $discount_rule->sortBy([
            ['priority','asc']
        ])->first();

        if($non_exclusive){
            return redirect()->back()->with([
                'success' => 'Discount Available',
                'discount_match' => [
                    'discount_type' => $non_exclusive->discount_type,
                    'discount_value' => $non_exclusive->discount_value,
                    'priority' => $non_exclusive->priority,
                    'amount' => $this->calculateDiscount($non_exclusive,$purchase_amount)
                ]
            ]);
        }

        return redirect()->back()->with('error', 'No Discount Available');
    }

    public function calculateDiscount($discount_rule,$purchase_amount){
        if($discount_rule->discount_type == 'Percentage'){
            $dis_amount = ($discount_rule->discount_value /100) * $purchase_amount;
            return $purchase_amount - $dis_amount;
        }
        return $purchase_amount - $discount_rule->discount_value;
    }
}
