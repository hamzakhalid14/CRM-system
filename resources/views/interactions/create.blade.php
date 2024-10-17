@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Interaction</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('interactions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="customer_id">Customer</label>
            <select class="form-control" id="customer_id" name="customer_id" required>
                <option value="">Select a customer</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3" required>{{ old('notes') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Interaction</button>
        <a href="{{ route('interactions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection