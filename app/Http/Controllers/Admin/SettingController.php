<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of application settings.
     */
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the application settings in storage.
     */
    public function update(Request $request)
    {
        $fields = [
            'site_name',
            'site_tagline',
            'site_description',
            'address',
            'phone',
            'whatsapp',
            'email',
            'working_hours',
            'facebook_url',
            'twitter_url',
            'instagram_url',
            'youtube_url',
            'footer_text',
        ];

        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'working_hours' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|string|max:255',
            'twitter_url' => 'nullable|string|max:255',
            'instagram_url' => 'nullable|string|max:255',
            'youtube_url' => 'nullable|string|max:255',
            'footer_text' => 'nullable|string',
        ]);

        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::set($field, $request->input($field));
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan situs web berhasil diperbarui.');
    }
}
