<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Notifications\NewLeadNotification;
use App\Models\User;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads = Lead::with('customer')->orderBy('created_at', 'desc')->paginate(10);
        return view('leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        return view('leads.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required|in:new,contacted,qualified,proposal,negotiation,closed_won,closed_lost',
            'notes' => 'nullable|string',
            'follow_up_date' => 'nullable|date',
        ]);

        $lead = Lead::create($validatedData);

        // Notify managers about the new lead
        $managers = User::where('role', 'manager')->get();
        foreach ($managers as $manager) {
            $manager->notify(new NewLeadNotification($lead));
        }

        return redirect()->route('leads.index')->with('success', 'Lead created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        return view('leads.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        $customers = Customer::all();
        return view('leads.edit', compact('lead', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lead $lead)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required|in:new,contacted,qualified,proposal,negotiation,closed_won,closed_lost',
            'notes' => 'nullable|string',
            'follow_up_date' => 'nullable|date',
        ]);

        $lead->update($validatedData);

        return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }
}