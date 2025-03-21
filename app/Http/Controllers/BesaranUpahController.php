<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BesaranUpah;

class BesaranUpahController extends Controller
{
    // Menampilkan semua data
    public function index()
    {
        $data = BesaranUpah::all();
        return view('admin.besaran_upah.index', compact('data'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        return view('admin.besaran_upah.create');
    }

    // Menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'is_active' => 'nullable|boolean'
        ]);

        BesaranUpah::create([
            'min' => $request->min,
            'max' => $request->max,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.besaran_upah.index')->with('success', 'Data berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit(BesaranUpah $besaranUpah)
    {
        return view('admin.besaran_upah.edit', compact('besaranUpah'));
    }

    // Menyimpan perubahan data
    public function update(Request $request, BesaranUpah $besaranUpah)
    {
        $request->validate([
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'is_active' => 'nullable|boolean'
        ]);

        $besaranUpah->update([
            'min' => $request->min,
            'max' => $request->max,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.besaran_upah.index')->with('success', 'Data berhasil diperbarui');
    }

    // Menghapus data
    public function destroy(BesaranUpah $besaranUpah)
    {
        $besaranUpah->delete();
        return redirect()->route('besaran_upah.index')->with('success', 'Data berhasil dihapus');
    }
}
