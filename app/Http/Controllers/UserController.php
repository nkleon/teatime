<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = \App\Models\User::paginate(15);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);
        $validated = $request->validated();
        $validated['password'] = Hash::make(env('DEFAULT_USER_PASSWORD', 'password'));
        User::create($validated);
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
        $this->authorize('update', $user);
        // Load all roles for the dropdown select field
    $roles = Role::all(); 

    return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // Authorization check
    $this->authorize('update', $user); 

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
    $validatedData['active'] = $request->has('active') ? 1 : 0;

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
    $this->authorize('delete', $user);
    
    // Check for collections linked to this user
    if ($user->collections()->exists()) {
        return redirect()->back()
            ->with('error', 'Cannot delete user. They are linked to existing collection records.');
    }

    $user->delete();

    return redirect()->route('users.index')
        ->with('success', 'User deleted successfully.');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only(['email','password']);

        if(Auth::attempt($credentials)){
            // typically define a route called dashboard
            return redirect()->intended('/');
        }

        return redirect()->route('login')
            ->withErrors(['general' => "Wrong username and/or password"]);  
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        //home page (landing page)
        return redirect()->to('/');
    }

    public function register()
    {
        $roles = Role::where('id', '!=', '1')->get();
        return view('auth.register', compact('roles'));
    }

    public function onboard(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users'),
            ],
            'phone' => [
                'required',
                'string',
                Rule::unique('users'),
            ],
            'role_id' => [
                'required',
                'exists:roles,id',
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create the user
        $user = User::create($validatedData);

        // Automatically log the user in
        Auth::login($user);

        // 5️⃣ Redirect or login
        return redirect()->intended('/')->with('success', 'Registration successful!.');
    }
}
