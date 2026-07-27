<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AirlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Airline::withCount('routes')->latest()->get();

        return view('admin.airlines.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.airlines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'code' => 'required|string|max:10|unique:airlines,code',
            'country' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('airlines', 'public');
        }

        Airline::create([
            'name' => $request->name,
            'code' => strtoupper($request->code),
            'country' => $request->country,
            'status' => $request->status,
            'logo' => $logoPath,
        ]);

        return redirect()->route('admin.airlines.index')->with('success', 'Airline created successfully!!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Airline $airline)
    {
        return view('admin.airlines.edit', compact('airline'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airline $airline)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'code' => 'required|string|max:10|unique:airlines,code,' . $airline->id,
            'country' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $logoPath = $airline->logo;
        if ($request->hasFile('logo')) {
            if ($airline->logo) {
                Storage::disk('public')->delete($airline->logo);
            }
            $logoPath = $request->file('logo')->store('airlines', 'public');
        }

        $airline->update([
            'name' => $request->name,
            'code' => strtoupper($request->code),
            'country' => $request->country,
            'status' => $request->status,
            'logo' => $logoPath,
        ]);

        return redirect()->route('admin.airlines.index')->with('success', 'Airline updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Airline $airline)
    {
        if ($airline->routes()->exists()) {
            return redirect()->route('admin.airlines.index')
                ->with('error', 'This airline is used by one or more routes and cannot be deleted. Remove those routes first.');
        }

        if ($airline->logo) {
            Storage::disk('public')->delete($airline->logo);
        }

        $airline->delete();

        return redirect()->route('admin.airlines.index')->with('success', 'Airline deleted successfully!!');
    }
}
