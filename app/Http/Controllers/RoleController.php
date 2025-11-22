<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;

class RoleController extends Controller
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
    public function store(StoreRoleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $validatedData = $request->validate([
        'name' => [
            'required',
            'string',
            // Ignore the current role's ID when checking for unique name
            Rule::unique('roles')->ignore($role->id),
        ],
        'description' => 'nullable|string',
    ]);

    $role->update($validatedData);

    return redirect()->route('roles.index')
        ->with('success', 'Role "' . $role->name . '" updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // Check for dependent users
    if ($role->users()->exists()) {
        return redirect()->back()
            ->with('error', 'Cannot delete role. It is assigned to existing users.');
    }
    
    // Cannot delete the primary role (e.g., ID 1 for 'Admin')
    // if ($role->id === 1) { ... } 

    $role->delete();

    return redirect()->route('roles.index')
        ->with('success', 'Role deleted successfully.');
    }
}
