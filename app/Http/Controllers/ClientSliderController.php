<?php

namespace App\Http\Controllers;

use App\Models\ClientSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientSliderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|max:2048',
        ]);

        $success = true;
        $messages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                try {
                    $path = $image->store('client-sliders', 'public');
                    
                    ClientSlider::create([
                        'image' => $path,
                        'order' => ClientSlider::count()
                    ]);

                    $messages[] = 'Logo client berhasil ditambahkan';
                } catch (\Exception $e) {
                    $success = false;
                    $messages[] = 'Gagal mengunggah salah satu logo client';
                }
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => $success,
                'messages' => $messages
            ]);
        }

        return redirect()->back()->with('success', implode(', ', $messages));
    }

    public function destroy($id)
    {
        $client = ClientSlider::findOrFail($id);
        
        if (Storage::disk('public')->exists($client->image)) {
            Storage::disk('public')->delete($client->image);
        }
        
        $client->delete();
        
        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->back()->with('success', 'Client berhasil dihapus');
    }
} 