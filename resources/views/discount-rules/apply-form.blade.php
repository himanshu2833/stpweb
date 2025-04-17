@extends('layouts.app')
@section('content')
    <h2>Discount Rule Apply</h2>
    <form action="{{ route('discount-rules.apply') }}" method="POST">
        @csrf
        @if($errors->any())
            <div class="alert alert-danger">
            {{ implode('', $errors->all(':message</br>')) }}
            </div>
        @endif
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-control">
                <option value="">Select Category</option>
                <option value="Book">Book</option>
                <option value="Clothing">Clothing</option>
                <option value="Electronics">Electronics</option>
                <option value="Furniture">Furniture</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Purchase Quantity</label>
            <input type="number" name="purchase_qty" min="1" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Purchase Date</label>
            <input type="date" name="purchase_date" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Purchase Amount</label>
            <input type="number" name="purchase_amount" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @if(session('discount_match'))
        {{ json_encode(session('discount_match')) }}
    @endif
@endsection