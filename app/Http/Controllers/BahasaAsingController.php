<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahasaAsing;

class BahasaAsingController extends Controller
{
    // Tampilkan daftar Bahasa Asing
    public function index()
    {
        $bahasa_asing = BahasaAsing::all();
        return view('admin.bahasa_asing.index', compact('bahasa_asing'));
    }

    // Tampilkan form tambah Bahasa Asing
    public function create()
    {
        return view('admin.bahasa_asing.create');
    }

    // Simpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean'
        ]);

        BahasaAsing::create($request->all());

        return redirect()->route('admin.bahasa_asing.index')->with('success', 'Bahasa Asing berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $bahasa_asing = BahasaAsing::findOrFail($id);
        return view('admin.bahasa_asing.edit', compact('bahasa_asing'));
    }

    // Update data di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean'
        ]);

        $bahasa_asing = BahasaAsing::findOrFail($id);
        $bahasa_asing->update($request->all());

        return redirect()->route('admin.bahasa_asing.index')->with('success', 'Bahasa Asing berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($id)
    {
        BahasaAsing::findOrFail($id)->delete();
        return redirect()->route('admin.bahasa_asing.index')->with('success', 'Bahasa Asing berhasil dihapus!');
    }
}
