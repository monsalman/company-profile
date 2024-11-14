<?php

namespace App\Http\Controllers;

use App\Models\HeroImage;
use App\Models\ClientSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSliderController extends Controller
{
    public function index()
    {
        $sliderImages = HeroImage::orderBy('created_at', 'desc')->get();
        $clientSliders = ClientSlider::orderBy('order')->get();
            
        return view('homepage', compact('sliderImages', 'clientSliders'));
    }

    public function storeHeroSlider(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $success = true;
        $messages = [];
        $sliders = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                try {
                    $path = $image->store('hero-images', 'public');

                    $slider = HeroImage::create([
                        'image' => $path,
                        'order' => HeroImage::count(),
                        'is_active' => true
                    ]);

                    $sliders[] = [
                        'id' => $slider->id,
                        'image_url' => Storage::url($path)
                    ];
                    $messages[] = 'Hero Slider berhasil ditambahkan';
                } catch (\Exception $e) {
                    $success = false;
                    $messages[] = 'Gagal mengunggah salah satu gambar slider';
                }
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => $success,
                'sliders' => $sliders,
                'messages' => $messages
            ]);
        }

        return redirect()->back()->with('success', implode(', ', $messages));
    }

    public function destroyHeroSlider($id)
    {
        $slider = HeroImage::findOrFail($id);
        
        if (Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }
        
        $slider->delete();
        
        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->back()->with('success', 'Hero Slider berhasil dihapus');
    }
} 