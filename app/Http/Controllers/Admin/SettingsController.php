<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display settings page.
     */
    public function index()
    {
        $settings = \App\Models\Setting::all()->pluck('value', 'key');
        
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method', 'app_logo']);

        // Handle regular settings
        foreach ($data as $key => $value) {
            \App\Models\Setting::set($key, $value);
        }

        // Handle logo upload
        if ($request->hasFile('app_logo')) {
            $path = $request->file('app_logo')->store('settings', 'public');
            \App\Models\Setting::set('app_logo', $path);
        }

        return back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
