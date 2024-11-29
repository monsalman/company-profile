<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        VisiMisi::updateOrCreate(
            ['key' => 'visi'],
            ['content' => $request->visi]
        );

        VisiMisi::updateOrCreate(
            ['key' => 'misi'],
            ['content' => $request->misi]
        );

        return response()->json(['success' => true]);
    }
}