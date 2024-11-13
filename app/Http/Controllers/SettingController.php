<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,jpg,jpeg|max:1024'
        ]);

        $faviconPath = null;
        $logoPath = null;
        $faviconRemoved = false;
        $logoRemoved = false;

        if ($request->hasFile('logo') || $request->has('remove_logo')) {
            $setting = Setting::where('key', 'logo')->first();
            
            if ($request->has('remove_logo')) {
                if ($setting && $setting->value && $setting->value !== 'logo.png') {
                    Storage::disk('public')->delete($setting->value);
                }
                Setting::updateOrCreate(
                    ['key' => 'logo'],
                    ['value' => 'logo.png']
                );
                $logoRemoved = true;
            } elseif ($request->hasFile('logo')) {
                if ($setting && $setting->value && $setting->value !== 'logo.png') {
                    Storage::disk('public')->delete($setting->value);
                }
                $logoPath = $request->file('logo')->store('logo', 'public');
                Setting::updateOrCreate(
                    ['key' => 'logo'],
                    ['value' => $logoPath]
                );
            }
        }

        if ($request->hasFile('favicon') || $request->has('remove_favicon')) {
            $setting = Setting::where('key', 'favicon')->first();
            
            if ($request->has('remove_favicon')) {
                if ($setting && $setting->value && $setting->value !== 'favicon.png') {
                    Storage::disk('public')->delete($setting->value);
                }
                Setting::updateOrCreate(
                    ['key' => 'favicon'],
                    ['value' => 'favicon.png']
                );
                $faviconRemoved = true;
            } elseif ($request->hasFile('favicon')) {
                if ($setting && $setting->value && $setting->value !== 'favicon.png') {
                    Storage::disk('public')->delete($setting->value);
                }
                $faviconPath = $request->file('favicon')->store('favicon', 'public');
                Setting::updateOrCreate(
                    ['key' => 'favicon'],
                    ['value' => $faviconPath]
                );
            }
        }

        if($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Logo dan favicon berhasil diperbarui',
                'favicon_path' => $faviconPath,
                'logo_path' => $logoPath,
                'favicon_removed' => $faviconRemoved,
                'logo_removed' => $logoRemoved,
                'timestamp' => time()
            ]);
        }

        return redirect()->back()->with('success', 'Logo dan favicon berhasil diperbarui');
    }
} 