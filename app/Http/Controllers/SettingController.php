<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Setting::all();

        return view('admin.settings.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only one settings record is needed for the site.
        if (Setting::exists()) {
            return redirect()->route('admin.settings.index')
                ->with('error', 'Settings already exist. Please edit the existing settings instead.');
        }

        return view('admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:150',
            'site_email' => 'required|email|max:150',
            'site_phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'footer_text' => 'nullable|string',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg,ico|max:1024',
        ]);

        $data = $request->only([
            'site_name',
            'site_email',
            'site_phone',
            'address',
            'footer_text',
            'facebook_url',
            'twitter_url',
            'instagram_url',
            'youtube_url',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            $data['favicon'] = $request->file('favicon')->store('settings', 'public');
        }

        Setting::create($data);

        return redirect()->route('admin.settings.index')->with('success', 'Settings saved successfully!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', ['item' => $setting]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'site_name' => 'required|string|max:150',
            'site_email' => 'required|email|max:150',
            'site_phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'footer_text' => 'nullable|string',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg,ico|max:1024',
        ]);

        $data = $request->only([
            'site_name',
            'site_email',
            'site_phone',
            'address',
            'footer_text',
            'facebook_url',
            'twitter_url',
            'instagram_url',
            'youtube_url',
        ]);

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            $data['logo'] = $request->file('logo')->store('settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            if ($setting->favicon) {
                Storage::disk('public')->delete($setting->favicon);
            }
            $data['favicon'] = $request->file('favicon')->store('settings', 'public');
        }

        $setting->update($data);

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        if ($setting->logo) {
            Storage::disk('public')->delete($setting->logo);
        }

        if ($setting->favicon) {
            Storage::disk('public')->delete($setting->favicon);
        }

        $setting->delete();

        return redirect()->route('admin.settings.index')->with('success', 'Settings deleted successfully!!');
    }
}
