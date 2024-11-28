<?php

namespace App\Http\Controllers;

use App\Models\ProfileKami;
use Illuminate\Http\Request;

class ProfileKamiController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description_1' => 'required|string',
            'description_2' => 'required|string',
        ]);

        ProfileKami::updateOrCreate(
            ['id' => 1],
            [
                'title' => $request->title,
                'description_1' => $request->description_1,
                'description_2' => $request->description_2,
            ]
        );

        return response()->json(['success' => true]);
    }
}
