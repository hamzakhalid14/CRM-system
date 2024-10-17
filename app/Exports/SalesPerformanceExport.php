<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesPerformanceExport implements FromCollection, WithHeadings
{
    public function collection()
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

        return collect($performanceData);
    }

    public function headings(): array
    {
        return [
            'Agent Name',
            'Closed Leads',
        ];
    }
}