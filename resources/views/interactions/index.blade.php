@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Interactions</h1>
    <a href="{{ route('interactions.create') }}" class="btn btn-primary mb-3">Add New Interaction</a>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>User</th>
                <th>Notes</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($interactions as $interaction)
                <tr>
                    <td>{{ $interaction->id }}</td>
                    <td>{{ $interaction->customer->name }}</td>
                    <td>{{ $interaction->user->name }}</td>
                    <td>{{ Str::limit($interaction->notes, 50) }}</td>
                    <td>{{ $interaction->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('interactions.show', $interaction->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('interactions.edit', $interaction->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('interactions.destroy', $interaction->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this interaction?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $interactions->links() }}
</div>
@endsection