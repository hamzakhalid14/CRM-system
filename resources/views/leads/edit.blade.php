@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Lead</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('leads.update', $lead->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="customer_id">Customer</label>
            <select class="form-control" id="customer_id" name="customer_id" required>
                <option value="">Select a customer</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id', $lead->customer_id) == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="">Select a status</option>
                @foreach (['new', 'contacted', 'qualified', 'proposal', 'negotiation', 'closed_won', 'closed_lost'] as $status)
                    <option value="{{ $status }}" {{ old('status', $lead->status) == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes', $lead->notes) }}</textarea>
        </div>
        <div class="form-group">
            <label for="follow_up_date">Follow-up Date</label>
            <input type="date" class="form-control" id="follow_up_date" name="follow_up_date" value="{{ old('follow_up_date', $lead->follow_up_date ? $lead->follow_up_date->format('Y-m-d') : '') }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Lead</button>
        <a href="{{ route('leads.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection