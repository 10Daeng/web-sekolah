<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key')->map(fn ($s) => $s->value);
        
        // Default values dari config jika DB kosong
        $defaults = config('app.sekolah', []);
        
        return view('admin.settings', compact('settings', 'defaults'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method', 'logo_file']);
        
        // Handle logo upload
        if ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $path = $file->store('settings', 'public');
            Setting::set('logo', Storage::disk('public')->url($path), 'general', 'string');
        }

        // Handle favicon upload
        if ($request->hasFile('favicon_file')) {
            $file = $request->file('favicon_file');
            $path = $file->store('settings', 'public');
            Setting::set('favicon', Storage::disk('public')->url($path), 'general', 'string');
        }

        // Save all settings
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $value = json_encode($value);
            }
            Setting::set($key, $value, 'general', 'string');
        }

        // Update config runtime
        $this->refreshConfig();

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil disimpan.');
    }

    private function refreshConfig(): void
    {
        $settings = Setting::all();
        $sekolahConfig = config('app.sekolah', []);

        foreach ($settings as $setting) {
            if (array_key_exists($setting->key, $sekolahConfig)) {
                $sekolahConfig[$setting->key] = $setting->value;
            }
        }

        config(['app.sekolah' => $sekolahConfig]);
    }
}
