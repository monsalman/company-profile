<?php

namespace App\Http\Controllers;

use App\Models\RetailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RetailServiceController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'title' => 'required|string|max:255',
                'description' => 'required|string'
            ]);

            $originalName = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('retail-services', $originalName, 'public');
            
            $retailService = RetailService::create([
                'image' => $path,
                'title' => $request->title,
                'description' => $request->description
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Retail service berhasil ditambahkan',
                'data' => $retailService
            ]);

        } catch (\Exception $e) {
            \Log::error('Error creating retail service: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, RetailService $retailService)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $data = $request->only(['title', 'description']);

            if ($request->hasFile('image')) {
                if (Storage::disk('public')->exists($retailService->image)) {
                    Storage::disk('public')->delete($retailService->image);
                }
                $originalName = $request->file('image')->getClientOriginalName();
                $data['image'] = $request->file('image')->storeAs('retail-services', $originalName, 'public');
            }

            $retailService->update($data);
            return response()->json(['success' => true]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data'
            ], 500);
        }
    }

    public function destroy(RetailService $retailService)
    {
        if (Storage::disk('public')->exists($retailService->image)) {
            Storage::disk('public')->delete($retailService->image);
        }
        
        $retailService->delete();
        return response()->json(['success' => true]);
    }
} 