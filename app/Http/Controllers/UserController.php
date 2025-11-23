<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = \App\Models\User::paginate(15);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create_user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());
        return redirect()->route('users.index')->with('success', 'User added!');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Load all roles for the dropdown select field
    $roles = Role::all(); 

    // Authorization check (e.g., only admin can access this)
    // $this->authorize('view', $user); 

    return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // Authorization check
    // $this->authorize('update', $user); 

    // 1. Validation Logic
    $validatedData = $request->validate([
        // *** CRITICAL UNIQUE CHECKS (UK in schema) ***
        'name' => [
            'required',
            'string',
            Rule::unique('users')->ignore($user->id),
        ],
        'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($user->id),
        ],
        'phone' => [
            'required',
            'string',
            Rule::unique('users')->ignore($user->id),
        ],
        // *** END CRITICAL CHECKS ***
        
        'role_id' => 'required|exists:roles,id', // FK to roles table
        'active' => 'nullable|boolean', // BOOLEAN field
        
        // Password is optional. Only validate if it's present.
        // The 'confirmed' rule requires a 'password_confirmation' field in the view.
        'password' => 'nullable|string|min:8|confirmed', 
    ]);

    // Handle 'active' boolean for unchecked checkbox
    $validatedData['active'] = $request->has('active');

    // 2. Handle Password Update
    if (!empty($validatedData['password'])) {
        // Hash the new password before saving
        $validatedData['password'] = Hash::make($validatedData['password']);
    } else {
        // If password field was empty, remove it from the data array
        // so the existing password remains unchanged in the database.
        unset($validatedData['password']);
    }

    // 3. Update the Record
    $user->update($validatedData);

    // 4. Redirect
    return redirect()->route('users.index')
        ->with('success', 'User ' . $user->name . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Authorization check (highly restricted, usually only by a Super Admin)
    // $this->authorize('delete', $user);
    
    // Check for collections linked to this user
    if ($user->collections()->exists()) {
        return redirect()->back()
            ->with('error', 'Cannot delete user. They are linked to existing collection records.');
    }

    $user->delete();

    return redirect()->route('users.index')
        ->with('success', 'User deleted successfully.');
    }
}
