<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    /**
     * Menampilkan daftar kelurahan.
     */
    public function index()
    {
        $kelurahans = Kelurahan::with('kecamatan')->paginate(10);
        return view('admin.kelurahan.index', compact('kelurahans'));
    }

    /**
     * Menampilkan form tambah kelurahan.
     */
    public function create()
    {
        $kecamatans = Kecamatan::all(); // Ambil dari master_kecamatan
        return view('admin.kelurahan.create', compact('kecamatans'));
    }

    /**
     * Menyimpan data kelurahan baru ke database.
     */
    public function store(Request $request)
{
    $request->validate([
        'id_kecamatan' => 'required|exists:master_kecamatan,id',
        'name' => 'required|string|max:255',
        'is_active' => 'required|boolean',
    ]);

    Kelurahan::create([
        'id_kecamatan' => $request->id_kecamatan,
        'name' => $request->name,
        'is_active' => $request->is_active,
    ]);

    return redirect()->route('admin.kelurahan.index')->with('success', 'Kelurahan berhasil ditambahkan.');
}


    /**
     * Menampilkan detail kelurahan tertentu.
     */
    public function show(Kelurahan $kelurahan)
    {
        return view('admin.kelurahan.show', compact('kelurahan'));
    }

    /**
     * Menampilkan form edit kelurahan.
     */
    public function edit(Kelurahan $kelurahan)
    {
        $kecamatans = Kecamatan::all(); // Mengambil dari master_kecamatan
        return view('admin.kelurahan.edit', compact('kelurahan', 'kecamatans'));
    }

    /**
     * Menyimpan perubahan data kelurahan.
     */
    public function update(Request $request, Kelurahan $kelurahan)
    {
        $request->validate([
            'id_kecamatan' => 'required|exists:master_kecamatan,id', 
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $kelurahan->update([
            'id_kecamatan' => $request->id_kecamatan,
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.kelurahan.index')->with('success', 'Kelurahan berhasil diperbarui');
    }

    /**
     * Menghapus kelurahan dari database.
     */
    public function destroy(Kelurahan $kelurahan)
    {
        $kelurahan->delete();
        return redirect()->route('admin.kelurahan.index')->with('success', 'Kelurahan berhasil dihapus');
    }
}
