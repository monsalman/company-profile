<?php

namespace App\Http\Controllers;

use App\Models\HeroImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSliderController extends Controller
{
    public function index()
    {
        $sliderImages = HeroImage::orderBy('created_at', 'desc')->get();
            
        return view('homepage', compact('sliderImages'));
    }

    public function storeHeroSlider(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image')->store('hero-images', 'public');

        $slider = HeroImage::create([
            'image' => $path,
            'order' => HeroImage::count(),
            'is_active' => true
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'slider_id' => $slider->id,
                'image_url' => Storage::url($path)
            ]);
        }

        return redirect()->back()->with('success', 'Hero Slider berhasil ditambahkan');
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