<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelompokJabatan;

class KelompokJabatanController extends Controller
{
    // Menampilkan semua data
    public function index()
    {
        $data = KelompokJabatan::all();
        return view('admin.kelompok_jabatan.index', compact('data'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        return view('admin.kelompok_jabatan.create');
    }

    // Menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean'
        ]);

        KelompokJabatan::create([
            'name' => $request->name,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.kelompok_jabatan.index')->with('success', 'Data berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit(KelompokJabatan $kelompokJabatan)
    {
        return view('admin.kelompok_jabatan.edit', compact('kelompokJabatan'));
    }

    // Menyimpan perubahan data
    public function update(Request $request, KelompokJabatan $kelompokJabatan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean'
        ]);

        $kelompokJabatan->update([
            'name' => $request->name,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.kelompok_jabatan.index')->with('success', 'Data berhasil diperbarui');
    }

    // Menghapus data
    public function destroy(KelompokJabatan $kelompokJabatan)
    {
        $kelompokJabatan->delete();
        return redirect()->route('admin.kelompok_jabatan.index')->with('success', 'Data berhasil dihapus');
    }
}
