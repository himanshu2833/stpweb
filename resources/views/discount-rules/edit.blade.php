@extends('layouts.app')
@section('content')
    <h2>Discount Rule Create</h2>
    <form action="{{ route('discount-rules.update',$discountRule) }}" method="POST">
        @csrf
        @method('PUT')
        @if($errors->any())
            <div class="alert alert-danger">
            {{ implode('', $errors->all(':message</br>')) }}
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-control">
                <option value="">Select Category</option>
                <option value="Book" {{$discountRule->category == 'Book' ? 'selected':''}}>Book</option>
                <option value="Clothing" {{$discountRule->category == 'Clothing' ? 'selected':''}}>Clothing</option>
                <option value="Electronics" {{$discountRule->category == 'Electronics' ? 'selected':''}}>Electronics</option>
                <option value="Furniture" {{$discountRule->category == 'Furniture' ? 'selected':''}}>Furniture</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Min Qty</label>
            <input type="number" name="min_qty" min="1" class="form-control" value="{{ old('min_qty',$discountRule->min_qty)}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Max qty</label>
            <input type="number" name="max_qty" min="1" class="form-control" value="{{ old('max_qty',$discountRule->max_qty)}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ old('start_date',$discountRule->start_date)}}">
        </div>
        <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ old('end_date',$discountRule->end_date)}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Discount Type</label>
            <select name="discount_type" class="form-control">
                <option value="Percentage" {{$discountRule->discount_type == 'Percentage' ? 'selected':''}}>Percentage</option>
                <option value="Fixed" {{$discountRule->discount_type == 'Fixed' ? 'selected':''}}>Fixed</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Discount Value</label>
            <input type="number" name="discount_value" min="1" class="form-control" value="{{ old('discount_value',$discountRule->discount_value)}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Priority</label>
            <input type="number" name="priority" min="1" max="5" class="form-control" value="{{ old('priority',$discountRule->priority)}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Exclusive</label>
            <input type="checkbox" name="is_exclusive" class="form-check-input" value="1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection