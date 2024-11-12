<?php

namespace App\Http\Controllers;

use App\Models\SliderImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $sliderImages = SliderImage::orderBy('created_at', 'desc')->get();
            
        return view('homepage', compact('sliderImages'));
    }

    public function storeSlider(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image')->store('sliders', 'public');

        $slider = SliderImage::create([
            'image' => $path,
            'order' => SliderImage::count(),
            'is_active' => true
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'slider_id' => $slider->id,
                'image_url' => $path
            ]);
        }

        return redirect()->back()->with('success', 'Slider berhasil ditambahkan');
    }

    public function destroySlider($id)
    {
        $slider = SliderImage::findOrFail($id);
        
        if (Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }
        
        $slider->delete();
        
        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->back()->with('success', 'Slider berhasil dihapus');
    }
}
