<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private const KEYS = [
        'clinic_name', 'clinic_phone', 'clinic_email', 'clinic_address',
        'opening_hours', 'healthengine_url', 'healthengine_embed_code',
        'google_map_embed', 'analytics_snippet', 'footer_text',
    ];

    public function edit()
    {
        $settings = collect(self::KEYS)->mapWithKeys(
            fn ($key) => [$key => Setting::get($key)]
        );

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'clinic_name' => ['required', 'string', 'max:255'],
            'clinic_phone' => ['nullable', 'string', 'max:50'],
            'clinic_email' => ['nullable', 'email', 'max:255'],
            'clinic_address' => ['nullable', 'string', 'max:500'],
            'opening_hours' => ['nullable', 'string', 'max:1000'],
            'healthengine_url' => ['nullable', 'url', 'max:1000'],
            'healthengine_embed_code' => ['nullable', 'string'],
            'google_map_embed' => ['nullable', 'string'],
            'analytics_snippet' => ['nullable', 'string'],
            'footer_text' => ['nullable', 'string', 'max:500'],
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings.edit')->with('status', 'Settings updated.');
    }
}
