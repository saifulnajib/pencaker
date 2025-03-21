<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TingkatPendidikan;

class TingkatPendidikanController extends Controller
{
    public function index()
    {
        $pendidikan = TingkatPendidikan::all();
        return view('admin.pendidikan.index', compact('pendidikan'));
    }

    public function create()
    {
        return view('admin.pendidikan.create');
    }

    public function store(Request $request)
    {
        if ($request->is_active == 'on' || $request->is_active == "1") {
            $request->merge(['is_active' => true]);
        } else {
            $request->merge(['is_active' => false]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'singkatan' => 'nullable|string|max:10',
            'is_active' => 'required|boolean',
        ]);

        TingkatPendidikan::create($request->all());
        return redirect()->route('admin.pendidikan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = TingkatPendidikan::findOrFail($id);
        return view('admin.pendidikan.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        if ($request->is_active == 'on' || $request->is_active == "1") {
            $request->merge(['is_active' => true]);
        } else {
            $request->merge(['is_active' => false]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'singkatan' => 'nullable|string|max:10',
            'is_active' => 'required|boolean',
        ]);

        $item = TingkatPendidikan::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('admin.pendidikan.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        TingkatPendidikan::findOrFail($id)->delete();
        return redirect()->route('admin.pendidikan.index')->with('success', 'Data berhasil dihapus');
    }
}
