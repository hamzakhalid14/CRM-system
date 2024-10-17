@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Customer Details</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $customer->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $customer->email }}</p>
            <p class="card-text"><strong>Phone:</strong> {{ $customer->phone ?: 'N/A' }}</p>
            <p class="card-text"><strong>Address:</strong> {{ $customer->address ?: 'N/A' }}</p>
        </div>
    </div>

    <h2 class="mt-4">Leads</h2>
    @if($customer->leads->count() > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customer->leads as $lead)
                    <tr>
                        <td>{{ $lead->id }}</td>
                        <td>{{ $lead->status }}</td>
                        <td>{{ $lead->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('leads.show', $lead->id) }}" class="btn btn-sm btn-info">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No leads found for this customer.</p>
    @endif

    <h2 class="mt-4">Interactions</h2>
    @if($customer->interactions->count() > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Notes</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customer->interactions as $interaction)
                    <tr>
                        <td>{{ $interaction->id }}</td>
                        <td>{{ $interaction->user->name }}</td>
                        <td>{{ $interaction->notes }}</td>
                        <td>{{ $interaction->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No interactions found for this customer.</p>
    @endif

    <div class="mt-4">
        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Edit Customer</a>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection