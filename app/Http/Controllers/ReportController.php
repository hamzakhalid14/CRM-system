<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesPerformanceExport;

class ReportController extends Controller
{
    public function salesPerformance()
    {
        $salesAgents = User::where('role', 'sales_agent')->get();
        $performanceData = [];

        foreach ($salesAgents as $agent) {
            $closedLeads = Lead::where('status', 'closed_won')
                ->whereHas('customer.interactions', function ($query) use ($agent) {
                    $query->where('user_id', $agent->id);
                })->count();

            $performanceData[] = [
                'agent_name' => $agent->name,
                'closed_leads' => $closedLeads,
            ];
        }

        return view('reports.sales-performance', compact('performanceData'));
    }

    public function exportSalesPerformance()
    {
        return Excel::download(new SalesPerformanceExport, 'sales_performance.xlsx');
    }
}