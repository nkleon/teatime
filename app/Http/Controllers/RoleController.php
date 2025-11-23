<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);
        $roles = \App\Models\Role::paginate(15);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Role::class);
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $this->authorize('create', Role::class);
        Role::create($request->validated());
        return redirect()->route('roles.index')->with('success', 'Role added');
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
        $this->authorize('update', $role);
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->authorize('update', $role);
        $validatedData = $request->validate([
        'name' => [
            'required',
            'string',
            // Ignore the current role's ID when checking for unique name
            Rule::unique('roles')->ignore($role->id),
        ],
        'description' => 'required|string',
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
        $this->authorize('delete', $role);
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
