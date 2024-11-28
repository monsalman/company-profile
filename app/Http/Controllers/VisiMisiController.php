<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visiMisi = VisiMisi::first();
        return view('visi-misi.index', compact('visiMisi'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'visi' => 'required',
            'visi_deskripsi' => 'required',
            'misi' => 'required',
            'misi_deskripsi' => 'required',
        ]);

        VisiMisi::updateOrCreate(
            ['id' => 1],
            $request->all()
        );

        return redirect()->back()->with('success', 'Visi dan Misi berhasil diperbarui');
    }
} 