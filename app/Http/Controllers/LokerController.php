<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loker;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Storage;

class LokerController extends Controller
{
    // Menampilkan daftar loker
    public function index()
    {
    $lokers = Loker::with('perusahaan')->get(); // Load relasi perusahaan
    return view('admin.loker.index', compact('lokers'));
    }


    // Menampilkan form tambah loker
    public function create()
    {
        $perusahaan = Perusahaan::all(); // Ambil semua perusahaan dari database
        return view('admin.loker.create', compact('perusahaan'));
    }

    // Menyimpan data loker baru
    public function store(Request $request)
{
    $validated = $request->validate([
        'id_perusahaan' => 'required',
        'posisi' => 'required|string',
        'deskripsi' => 'required|string',
        'kualifikasi' => 'required|string',
        'lokasi' => 'required|string',
        'gaji' => 'required',
        'expired' => 'required|date',
        'gambar' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048'
    ]);

    if ($request->hasFile('gambar')) {
        $validated['gambar'] = $request->file('gambar')->store('loker', 'public');
    }

    Loker::create($validated);

    return redirect()->route('loker.index')->with('success', 'Loker berhasil ditambahkan!');
}
    // Menampilkan form edit loker
    public function edit($id)
    {
    $loker = Loker::findOrFail($id); 
    $perusahaan = Perusahaan::all(); // Ambil semua perusahaan
    return view('admin.loker.edit', compact('loker', 'perusahaan'));
    }

    // Memperbarui data loker
    public function update(Request $request, $id)
{
    $loker = Loker::findOrFail($id);

    $validated = $request->validate([
        'id_perusahaan' => 'required',
        'posisi' => 'required|string',
        'deskripsi' => 'required|string',
        'kualifikasi' => 'required|string',
        'lokasi' => 'required|string',
        'gaji' => 'required',
        'expired' => 'required|date',
        'gambar' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048'
    ]);

    if ($request->hasFile('gambar')) {
        if ($loker->gambar) {
            Storage::disk('public')->delete($loker->gambar);
        }
        $validated['gambar'] = $request->file('gambar')->store('loker', 'public');
    }

    $loker->update($validated);

    return redirect()->route('loker.index')->with('success', 'Loker berhasil diperbarui!');
}


    // Menghapus data loker
    public function destroy($id)
{
    $loker = Loker::findOrFail($id);

    if ($loker->gambar) {
        Storage::disk('public')->delete($loker->gambar);
    }

    $loker->delete();

    return redirect()->route('loker.index')->with('success', 'Loker berhasil dihapus!');
}

}
