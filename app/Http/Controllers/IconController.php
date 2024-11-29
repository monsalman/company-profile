<?php

namespace App\Http\Controllers;

use App\Models\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IconController extends Controller
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
            $icon = Icon::where('key', 'logo')->first();
            
            if ($request->has('remove_logo')) {
                if ($icon && $icon->value && $icon->value !== 'logo.png') {
                    Storage::disk('public')->delete($icon->value);
                }
                Icon::updateOrCreate(
                    ['key' => 'logo'],
                    ['value' => 'logo.png']
                );
                $logoRemoved = true;
            } elseif ($request->hasFile('logo')) {
                if ($icon && $icon->value && $icon->value !== 'logo.png') {
                    Storage::disk('public')->delete($icon->value);
                }
                $logoPath = $request->file('logo')->store('logo', 'public');
                Icon::updateOrCreate(
                    ['key' => 'logo'],
                    ['value' => $logoPath]
                );
            }
        }

        if ($request->hasFile('favicon') || $request->has('remove_favicon')) {
            $icon = Icon::where('key', 'favicon')->first();
            
            if ($request->has('remove_favicon')) {
                if ($icon && $icon->value && $icon->value !== 'favicon.png') {
                    Storage::disk('public')->delete($icon->value);
                }
                Icon::updateOrCreate(
                    ['key' => 'favicon'],
                    ['value' => 'favicon.png']
                );
                $faviconRemoved = true;
            } elseif ($request->hasFile('favicon')) {
                if ($icon && $icon->value && $icon->value !== 'favicon.png') {
                    Storage::disk('public')->delete($icon->value);
                }
                $faviconPath = $request->file('favicon')->store('favicon', 'public');
                Icon::updateOrCreate(
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