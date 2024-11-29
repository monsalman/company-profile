<?php

namespace App\Http\Controllers;

use App\Models\RetailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RetailServiceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required',
            'description' => 'required'
        ]);

        $path = $request->file('image')->store('retail-services', 'public');
        
        RetailService::create([
            'image' => $path,
            'title' => $request->title,
            'description' => $request->description
        ]);

        return response()->json(['success' => true]);
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
                $data['image'] = $request->file('image')->store('retail-services', 'public');
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