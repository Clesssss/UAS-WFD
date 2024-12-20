<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(User $user)
    {
        // You can pass the user to the view if needed
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the incoming request
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'age' => 'required|integer|min:0',
            'gender' => 'required|string|in:male,female,other',
        ]);

        // Update the user's profile
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'age' => $request->age,
            'gender' => $request->gender,
        ]);

        // Redirect back with a success message
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
