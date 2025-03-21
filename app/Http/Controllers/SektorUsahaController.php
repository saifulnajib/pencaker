<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SektorUsaha;

class SektorUsahaController extends Controller
{
    public function index()
    {
        $sektorUsaha = SektorUsaha::all();
        return view('admin.sektor_usaha.index', compact('sektorUsaha'));
    }

    public function create()
    {
        return view('admin.sektor_usaha.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        SektorUsaha::create($request->all());

        return redirect()->route('admin.sektor_usaha.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $sektorUsaha = SektorUsaha::findOrFail($id);
        return view('admin.sektor_usaha.edit', compact('sektorUsaha'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $sektorUsaha = SektorUsaha::findOrFail($id);
        $sektorUsaha->update($request->all());

        return redirect()->route('admin.sektor_usaha.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        SektorUsaha::findOrFail($id)->delete();
        return redirect()->route('admin.sektor_usaha.index')->with('success', 'Data berhasil dihapus!');
    }
}
