<?php

namespace App\Http\Controllers;

use App\Models\Airplane;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AirplaneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Airplane::withCount('schedules')->latest()->get();

        return view('admin.airplanes.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.airplanes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'model' => 'nullable|string|max:100',
            'code' => 'required|string|max:20|unique:airplanes,code',
            'seat_rows' => 'required|integer|min:1|max:100',
            'seat_columns' => 'required|integer|min:1|max:10',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('airplanes', 'public');
        }

        Airplane::create([
            'name' => $data['name'],
            'model' => $data['model'] ?? null,
            'code' => strtoupper($data['code']),
            'seat_rows' => $data['seat_rows'],
            'seat_columns' => $data['seat_columns'],
            'total_seats' => $data['seat_rows'] * $data['seat_columns'],
            'status' => $data['status'],
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.airplanes.index')->with('success', 'Airplane created successfully!!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Airplane $airplane)
    {
        return view('admin.airplanes.edit', compact('airplane'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airplane $airplane)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'model' => 'nullable|string|max:100',
            'code' => 'required|string|max:20|unique:airplanes,code,' . $airplane->id,
            'seat_rows' => 'required|integer|min:1|max:100',
            'seat_columns' => 'required|integer|min:1|max:10',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $airplane->image;
        if ($request->hasFile('image')) {
            if ($airplane->image) {
                Storage::disk('public')->delete($airplane->image);
            }
            $imagePath = $request->file('image')->store('airplanes', 'public');
        }

        $airplane->update([
            'name' => $data['name'],
            'model' => $data['model'] ?? null,
            'code' => strtoupper($data['code']),
            'seat_rows' => $data['seat_rows'],
            'seat_columns' => $data['seat_columns'],
            'total_seats' => $data['seat_rows'] * $data['seat_columns'],
            'status' => $data['status'],
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.airplanes.index')->with('success', 'Airplane updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Airplane $airplane)
    {
        if ($airplane->schedules()->exists()) {
            return redirect()->route('admin.airplanes.index')
                ->with('error', 'This airplane is assigned to one or more flight schedules and cannot be deleted. Remove those schedules first.');
        }

        if ($airplane->image) {
            Storage::disk('public')->delete($airplane->image);
        }

        $airplane->delete();

        return redirect()->route('admin.airplanes.index')->with('success', 'Airplane deleted successfully!!');
    }
}
