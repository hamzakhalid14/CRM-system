@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Sales Performance Report</h1>

    <a href="{{ route('reports.sales-performance.export') }}" class="btn btn-primary mb-3">Export to Excel</a>

    <table class="table">
        <thead>
            <tr>
                <th>Agent Name</th>
                <th>Closed Leads</th>
            </tr>
        </thead>
        <tbody>
            @foreach($performanceData as $data)
            <tr>
                <td>{{ $data['agent_name'] }}</td>
                <td>{{ $data['closed_leads'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection