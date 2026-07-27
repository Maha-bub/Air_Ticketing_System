<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AgentManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Agent::with('user')->latest()->get();
        return view('admin.crud.agent.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.crud.agent.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|max:50',
            'address' => 'nullable|string|max:255',
            'task' => 'nullable|string|max:150',
            'status' => 'required|in:active,inactive',
            'joining_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = 'default.png';
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('agents', 'public');
        }

        DB::transaction(function () use ($request, $imagePath) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'agent',
            ]);

            Agent::create([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'address' => $request->address,
                'task' => $request->task,
                'status' => $request->status,
                'joining_date' => $request->joining_date,
                'image' => $imagePath,
            ]);
        });

        return redirect()->route('admin.agents.index')->with('success', 'Agent added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agentlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agent $agentlist)
    {
        $agentlist->load('user');
        return view('admin.crud.agent.edit', compact('agentlist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agent $agentlist)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $agentlist->user_id,
            'password' => 'nullable|string|min:6|confirmed',
            'phone' => 'required|string|max:50',
            'address' => 'nullable|string|max:255',
            'task' => 'nullable|string|max:150',
            'status' => 'required|in:active,inactive',
            'joining_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $agentlist->image;
        if ($request->hasFile('image')) {
            if ($agentlist->image && $agentlist->image !== 'default.png') {
                Storage::disk('public')->delete($agentlist->image);
            }
            $imagePath = $request->file('image')->store('agents', 'public');
        }

        DB::transaction(function () use ($request, $agentlist, $imagePath) {
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $agentlist->user()->update($userData);

            $agentlist->update([
                'phone' => $request->phone,
                'address' => $request->address,
                'task' => $request->task,
                'status' => $request->status,
                'joining_date' => $request->joining_date,
                'image' => $imagePath,
            ]);
        });

        return redirect()->route('admin.agents.index')->with('success', 'Agent updated successfully!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agentlist)
    {
        if ($agentlist->image && $agentlist->image !== 'default.png') {
            Storage::disk('public')->delete($agentlist->image);
        }

        $user = $agentlist->user;
        $agentlist->delete();

        if ($user) {
            $user->delete();
        }

        return redirect()->route('admin.agents.index')->with('success', 'Agent deleted successfully!');
    }
}
