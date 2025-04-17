@extends('layouts.app')
@section('content')
    <h2>Discount Rule Create</h2>
    <form action="{{ route('discount-rules.store') }}" method="POST">
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
            <label class="form-label">Min Qty</label>
            <input type="number" name="min_qty" min="1" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Max qty</label>
            <input type="number" name="max_qty" min="1" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Discount Type</label>
            <select name="discount_type" class="form-control">
                <option value="Percentage">Percentage</option>
                <option value="Fixed">Fixed</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Discount Value</label>
            <input type="number" name="discount_value" min="1" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Priority</label>
            <input type="number" name="priority" min="1" max="5" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Exclusive</label>
            <input type="checkbox" name="is_exclusive" class="form-check-input" value="1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection