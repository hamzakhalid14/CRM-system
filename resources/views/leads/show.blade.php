@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lead Details</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Lead #{{ $lead->id }}</h5>
            <p class="card-text"><strong>Customer:</strong> {{ $lead->customer->name }}</p>
            <p class="card-text"><strong>Status:</strong> {{ ucfirst($lead->status) }}</p>
            <p class="card-text"><strong>Follow-up Date:</strong> {{ $lead->follow_up_date ? \Carbon\Carbon::parse($lead->follow_up_date)->format('Y-m-d') : 'N/A' }}</p>
            <p class="card-text"><strong>Notes:</strong> {{ $lead->notes ?: 'N/A' }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $lead->created_at->format('Y-m-d H:i:s') }}</p>
            <p class="card-text"><strong>Updated At:</strong> {{ $lead->updated_at->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>

    <h2 class="mt-4">Interactions</h2>
    @if($lead->customer->interactions->count() > 0)
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
                @foreach($lead->customer->interactions as $interaction)
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
        <p>No interactions found for this lead's customer.</p>
    @endif

    <div class="mt-4">
        <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-warning">Edit Lead</a>
        <a href="{{ route('leads.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection