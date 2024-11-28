<?php

namespace App\Http\Controllers;

use App\Models\ServiceCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceCardController extends Controller
{
    public function index()
    {
        $serviceCards = ServiceCard::all();
        return view('service-cards.index', compact('serviceCards'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required',
            'description' => 'required'
        ]);

        $originalName = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('service-cards', $originalName, 'public');
        
        ServiceCard::create([
            'image' => $path,
            'title' => $request->title,
            'description' => $request->description
        ]);

        return response()->json(['success' => true]);
    }

    public function update(Request $request, ServiceCard $serviceCard)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ], [
                'title.required' => 'Judul harus diisi',
                'description.required' => 'Deskripsi harus diisi',
                'image.image' => 'File harus berupa gambar',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
                'image.max' => 'Ukuran gambar maksimal 2MB'
            ]);

            $data = $request->only(['title', 'description']);

            if ($request->hasFile('image')) {
                if (Storage::disk('public')->exists($serviceCard->image)) {
                    Storage::disk('public')->delete($serviceCard->image);
                }
                $originalName = $request->file('image')->getClientOriginalName();
                $data['image'] = $request->file('image')->storeAs('service-cards', $originalName, 'public');
            }

            $serviceCard->update($data);
            return response()->json(['success' => true]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data'
            ], 500);
        }
    }

    public function destroy(ServiceCard $serviceCard)
    {
        if (Storage::disk('public')->exists($serviceCard->image)) {
            Storage::disk('public')->delete($serviceCard->image);
        }
        
        $serviceCard->delete();
        return response()->json(['success' => true]);
    }
} 