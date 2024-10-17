@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Customers</h5>
                    <p class="card-text display-4">{{ $totalCustomers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Leads</h5>
                    <p class="card-text display-4">{{ $totalLeads }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Leads by Status</h5>
                    <canvas id="leadsByStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h2>Recent Interactions</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>User</th>
                        <th>Notes</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentInteractions as $interaction)
                    <tr>
                        <td>{{ $interaction->customer->name }}</td>
                        <td>{{ $interaction->user->name }}</td>
                        <td>{{ Str::limit($interaction->notes, 50) }}</td>
                        <td>{{ $interaction->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('leadsByStatusChart').getContext('2d');
    var leadsByStatusChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($leadsByStatus->keys()) !!},
            datasets: [{
                data: {!! json_encode($leadsByStatus->values()) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                ],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Leads by Status'
                }
            }
        }
    });
</script>
@endpush