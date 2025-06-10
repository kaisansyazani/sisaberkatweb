<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
{
    $user = auth()->user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:15',
        'address' => 'nullable|string|max:255',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    // Remove password if not provided
    if (empty($validated['password'])) {
        unset($validated['password']);
    } else {
        $validated['password'] = bcrypt($validated['password']);
    }

    $user->update($validated);

    return redirect()->back()->with('status', 'Profile updated successfully!');
}
 public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }
}
