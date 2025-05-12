<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\Loker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerusahaanController extends Controller
{
    public function index()
    {
        $perusahaans = Perusahaan::all();
        return view('admin.perusahaan.index', compact('perusahaans'));
    }

    public function create()
    {
        return view('admin.perusahaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'telp' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $perusahaan = new Perusahaan();
        $perusahaan->name = $request->name;
        $perusahaan->alamat = $request->alamat;
        $perusahaan->email = $request->email;
        $perusahaan->telp = $request->telp;
        $perusahaan->is_active = $request->is_active;

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $perusahaan->logo = $path;
        }

        $perusahaan->save();

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        return view('admin.perusahaan.edit', compact('perusahaan'));
    }

    public function update(Request $request, $id)
    {
        if ($request->is_active == '1') {
            $request->merge(['is_active' => true]);
        } else {
            $request->merge(['is_active' => false]);
        }
        
        $request->validate([
            'name' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'telp' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'required|boolean',
        ]);

        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->name = $request->name;
        $perusahaan->alamat = $request->alamat;
        $perusahaan->email = $request->email;
        $perusahaan->telp = $request->telp;
        $perusahaan->is_active = $request->is_active;

        if ($request->hasFile('logo')) {
            if ($perusahaan->logo) {
                Storage::delete('public/' . $perusahaan->logo);
            }
            $path = $request->file('logo')->store('logos', 'public');
            $perusahaan->logo = $path;
        }

        $perusahaan->save();

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil diperbarui!');
    }

    public function updateStatus(Request $request, $id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->is_active = $request->is_active;
        $perusahaan->save();

        return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui']);
    }

    public function destroy($id)
{
    $perusahaan = Perusahaan::findOrFail($id);

    // Set id_perusahaan di tabel lokers menjadi NULL
    Loker::where('id_perusahaan', $id)->update(['id_perusahaan' => null]);

    // Hapus perusahaan
    $perusahaan->delete();

    return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil dihapus');
}

}
