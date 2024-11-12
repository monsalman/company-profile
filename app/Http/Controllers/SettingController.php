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
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            $oldLogo = Setting::where('key', 'logo')->first();
            if ($oldLogo) {
                Storage::disk('public')->delete($oldLogo->value);
            }

            // Upload logo baru
            $path = $request->file('logo')->store('logo', 'public');
            
            // Simpan/update path di database
            Setting::updateOrCreate(
                ['key' => 'logo'],
                ['value' => $path]
            );

            return redirect()->back()->with('success', 'Logo berhasil diperbarui');
        }

        return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupload logo');
    }
} 