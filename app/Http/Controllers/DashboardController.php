<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\Interaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = Customer::count();
        $totalLeads = Lead::count();
        $recentInteractions = Interaction::with(['customer', 'user'])
                                         ->orderBy('created_at', 'desc')
                                         ->take(5)
                                         ->get();
        $leadsByStatus = Lead::groupBy('status')
                             ->selectRaw('status, count(*) as count')
                             ->pluck('count', 'status');

        return view('dashboard', compact('totalCustomers', 'totalLeads', 'recentInteractions', 'leadsByStatus'));
    }
}