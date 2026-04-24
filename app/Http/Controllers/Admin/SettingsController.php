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
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            \App\Models\Setting::set($key, $value);
        }

        return back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
