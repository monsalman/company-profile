<?php

namespace App\Http\Controllers;

use App\Models\HeroContent;
use Illuminate\Http\Request;

class HeroContentController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        // Update atau create content
        HeroContent::updateOrCreate(
            ['id' => 1], // Selalu update/create record pertama
            [
                'title' => $request->title,
                'description' => $request->description
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Hero content berhasil diperbarui'
        ]);
    }
} 