<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        Layanan::updateOrCreate(
            ['key' => 'service_custom'],
            [
                'title' => $request->title,
                'description' => $request->description
            ]
        );

        return response()->json(['success' => true]);
    }

    public function updateRetail(Request $request)
    {
        $layanan = Layanan::updateOrCreate(
            ['key' => 'service_retail'],
            [
                'title' => $request->title,
                'description' => $request->description
            ]
        );

        return response()->json(['success' => true]);
    }
} 