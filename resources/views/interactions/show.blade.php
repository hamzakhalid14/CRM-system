@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Interaction Details</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Interaction #{{ $interaction->id }}</h5>
            <p class="card-text"><strong>Customer:</strong> {{ $interaction->customer->name }}</p>
            <p class="card-text"><strong>User:</strong> {{ $interaction->user->name }}</p>
            <p class="card-text"><strong>Notes:</strong> {{ $interaction->notes }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $interaction->created_at->format('Y-m-d H:i:s') }}</p>
            <p class="card-text"><strong>Updated At:</strong> {{ $interaction->updated_at->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('interactions.edit', $interaction->id) }}" class="btn btn-warning">Edit Interaction</a>
        <a href="{{ route('interactions.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection