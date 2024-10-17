@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Leads</h1>
    <a href="{{ route('leads.create') }}" class="btn btn-primary mb-3">Add New Lead</a>
    
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
                <th>Status</th>
                <th>Follow-up Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
            use \Carbon\Carbon;
            @endphp
            @foreach ($leads as $lead)
                <tr>
                    <td>{{ $lead->id }}</td>
                    <td>{{ $lead->customer->name }}</td>
                    <td>{{ ucfirst($lead->status) }}</td>
                    <td>{{ $lead->follow_up_date ? Carbon::parse($lead->follow_up_date)->format('Y-m-d') : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('leads.show', $lead->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this lead?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $leads->links() }}
</div>
@endsection