<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollectionRequest;
use App\Http\Requests\UpdateCollectionRequest;
use App\Models\Collection;
use App\Models\Farm;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CollectionController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Collection::class);
        $user = auth()->user();
        if($user->role_id == 1) {
            $collections = Collection::with(['farm', 'picker'])->paginate(15);
        } else if ($user->role_id == 3) {
            $collections = Collection::where('picker_id', $user->id)->with(['farm', 'picker'])->paginate(15);
        } else if ($user->role_id == 2) {
            $collections = Collection::whereHas('farm', function ($query) use ($user) {
                $query->where('owner_id', $user->id);
            })
            ->with(['farm', 'picker'])
            ->paginate(15);
        }
        // $collections = Collection::with(['farm', 'picker'])->paginate(15);
        return view('collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Collection::class);
        $user = auth()->user();
        if($user->role_id == 1)
        {
            $farms = Farm::where('active', true)->get();
        } 
        else if ($user->role_id == 2)
        {
            $farms = Farm::where(['active' => true, 'owner_id' => $user->id])->get();
        }
        // $farms = Farm::where('active', true)->get();
        $pickers = User::where(['role_id' => 3, 'active' => true])->get();
        return view('collections.create', compact('farms', 'pickers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCollectionRequest $request)
    {
        $this->authorize('create', Collection::class);
        Collection::create($request->validated());
        return redirect()->route('collections.index')->with('success', 'Collection added');

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
        $this->authorize('update', $collection);
        $user = auth()->user();
        if($user->role_id == 1)
        {
            $farms = Farm::all();
        } 
        else if ($user->role_id == 2)
        {
            $farms = Farm::where('owner_id', $user->id)->get();
        }


        // Load active farms and all users (pickers) for the dropdowns
        // $farms = Farm::all();
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
        $this->authorize('update', $collection);
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
        $this->authorize('delete', $collection);
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
