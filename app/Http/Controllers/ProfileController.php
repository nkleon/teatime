<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // ignore own email
            ],
            'phone' => [
                'required',
                'string',
                Rule::unique('users')->ignore($user->id), // ignore own phone
            ],
            'password' => 'nullable|string|min:8|confirmed', // optional
        ]);

        // Hash the password if it was provided
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // don't overwrite password
        }

        // Update the user record
        $user->update($validated);

        // Redirect back with success message
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }
}
