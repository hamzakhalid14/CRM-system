<?php

namespace App\Http\Controllers;

use App\Models\Interaction;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InteractionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $interactions = Interaction::with(['customer', 'user'])->orderBy('created_at', 'desc')->paginate(10);
        return view('interactions.index', compact('interactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        return view('interactions.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'notes' => 'required|string',
        ]);

        $interaction = new Interaction($validatedData);
        $interaction->user_id = Auth::id();
        $interaction->save();

        return redirect()->route('interactions.index')->with('success', 'Interaction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Interaction $interaction)
    {
        return view('interactions.show', compact('interaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interaction $interaction)
    {
        $customers = Customer::all();
        return view('interactions.edit', compact('interaction', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Interaction $interaction)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'notes' => 'required|string',
        ]);

        $interaction->update($validatedData);

        return redirect()->route('interactions.index')->with('success', 'Interaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interaction $interaction)
    {
        $interaction->delete();

        return redirect()->route('interactions.index')->with('success', 'Interaction deleted successfully.');
    }
}