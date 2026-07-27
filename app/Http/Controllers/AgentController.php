<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AgentController extends Controller
{
     public function dashboard()
    {
        $user = Auth::user();
        $agent = $user->agent;

        return view('agent.dashboard', compact('user', 'agent'));
    }

    /**
     * Show the logged-in agent's own profile.
     */
    public function profile()
    {
        $user = Auth::user();
        $agent = $user->agent;

        return view('agent.profile.show', compact('user', 'agent'));
    }

    /**
     * Show the form to edit the logged-in agent's own profile.
     */
    public function editProfile()
    {
        $user = Auth::user();
        $agent = $user->agent;

        return view('agent.profile.edit', compact('user', 'agent'));
    }

    /**
     * Update the logged-in agent's own profile information.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $agent = $user->agent;

        if ($agent) {
            $imagePath = $agent->image;

            if ($request->hasFile('image')) {
                if ($agent->image && $agent->image !== 'default.png') {
                    Storage::disk('public')->delete($agent->image);
                }
                $imagePath = $request->file('image')->store('agents', 'public');
            }

            $agent->update([
                'phone' => $request->phone,
                'address' => $request->address,
                'image' => $imagePath,
            ]);
        }

        return redirect()->route('agent.profile')->with('success', 'Profile updated successfully!');
    }

    /**
     * Update the logged-in agent's own password.
     */
    public function updatePassword(Request $request)
    {
        $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }
}
