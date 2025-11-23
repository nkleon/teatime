<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFarmRequest;
use App\Http\Requests\UpdateFarmRequest;
use App\Models\Farm;
use App\Models\Role;
use App\Models\User;
use Illuminate\Validation\Rule;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farms = Farm::paginate(15);
        return view('farms.index', compact('farms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $ownerRoleId = Role::where('name', 'owner')->value('id');
        $owners = User::where('role_id', 2)->get();
        return view('farms.create', compact('owners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFarmRequest $request)
    {
        Farm::create($request->validated());
        return redirect()->route('farms.index')->with('success', 'Farm added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Farm $farm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Farm $farm)
    {
        $ownerRoleId = Role::where('name', 'owner')->value('id');
        $owners = User::where('role_id', $ownerRoleId)->get();
        return view('farms.edit', compact('farm', 'owners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFarmRequest $request, Farm $farm)
    {
      // 1. Validation Logic
    $validatedData = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            // *** IGNORE the current farm's ID for the unique check ***
            Rule::unique('farms')->ignore($farm->id),
        ],
        'rate' => 'required|numeric|min:0.01',
        // Validate 'active' as a boolean (if present, must be '1' or '0')
        'active' => 'nullable|boolean', 
        'owner_id' => 'required|exists:users,id'
    ]);

    // Handle 'active' for unchecked checkbox (if 'active' is not in request, set it to false)
    $validatedData['active'] = $request->has('active');
    //dd($validatedData, $request->all());
    // 2. Update the Record
    $farm->update($validatedData);

    // 3. Redirect
    return redirect()->route('farms.index')
        ->with('success', 'Farm "' . $farm->name . '" updated successfully!');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Farm $farm)
    {
       // Authorization check
    // $this->authorize('delete', $farm);
    
    // CRITICAL: Check for dependent records (e.g., collections)
    // If your migrations did NOT set onDelete('cascade') for collections, 
    // you must prevent deletion if related records exist.
    if ($farm->collections()->exists()) {
        return redirect()->back()
            ->with('error', 'Cannot delete farm. It has existing collection records.');
    }

    $farm->delete();

    return redirect()->route('farms.index')
        ->with('success', 'Farm deleted successfully.'); 
    }
}
