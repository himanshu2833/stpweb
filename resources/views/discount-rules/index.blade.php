@extends('layouts.app')
@section('content')
    <h2>Discount Rule Index</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Min Qty</th>
                <th>Max Qty</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Discount Type</th>
                <th>Discount Value</th>
                <th>Priority</th>
                <th>Is Exclusive</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($discountRules as $discountRule)
                <tr>
                    <td>{{ $discountRule->category }}</td>
                    <td>{{ $discountRule->min_qty }}</td>
                    <td>{{ $discountRule->max_qty }}</td>
                    <td>{{ $discountRule->start_date }}</td>
                    <td>{{ $discountRule->end_date }}</td>
                    <td>{{ $discountRule->discount_type }}</td>
                    <td>{{ $discountRule->discount_value }}</td>
                    <td>{{ $discountRule->priority }}</td>
                    <td>{{ $discountRule->is_exclusive ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('discount-rules.edit',$discountRule) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('discount-rules.destroy',$discountRule) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection