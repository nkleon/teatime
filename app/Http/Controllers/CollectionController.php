<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollectionRequest;
use App\Http\Requests\UpdateCollectionRequest;
use App\Models\Collection;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCollectionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Collection $collection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collection $collection)
    {
        // Load active farms and all users (pickers) for the dropdowns
    $farms = Farm::where('active', true)->get();
    $pickers = User::all(); 

    // Authorization check (e.g., must be admin or the original picker)
    // $this->authorize('update', $collection); 

    return view('collections.edit', compact('collection', 'farms', 'pickers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCollectionRequest $request, Collection $collection)
    {
        // 1. Validation Logic
    $validatedData = $request->validate([
        'date' => 'required|date',
        // Quantity must be a positive number
        'quantity' => 'required|numeric|min:0.01', 
        
        // FK constraint checks: Must exist in the 'farms' table
        'farm_id' => 'required|exists:farms,id', 
        // FK constraint checks: Must exist in the 'users' table
        'picker_id' => 'required|exists:users,id', 
    ]);

    // 2. Update the Record
    $collection->update($validatedData);

    // 3. Redirect
    return redirect()->route('collections.index')
        ->with('success', 'Collection record for ' . $collection->date . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection)
    {
        // Authorization check
    // $this->authorize('delete', $collection); 
    
    // CRITICAL: Check if this collection has an associated payment.
    // If a payment exists (payment_id FK to payments is set), the collection should not be deleted
    // unless the payment is deleted first.
    if ($collection->payment()->exists()) { 
        return redirect()->back()
            ->with('error', 'Cannot delete collection. It has already been linked to a payment.');
    }

    $collection->delete();

    return redirect()->route('collections.index')
        ->with('success', 'Collection record deleted successfully.');
    }
}
