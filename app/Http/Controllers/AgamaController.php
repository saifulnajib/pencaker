<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agama;

class AgamaController extends Controller
{
    public function index()
    {
        $agama = Agama::all();
        return view('admin.agama.index', compact('agama'));
    }

    public function create()
    {
        return view('admin.agama.create');
    }

    public function store(Request $request)
    {
        if ($request->is_active == 'on' || $request->is_active == "1") {
            $request->merge(['is_active' => true]);
        } else {
            $request->merge(['is_active' => false]);
        }

        $request->validate([
            'name' => 'required|string|max:50',
            'is_active' => 'required|boolean',
        ]);

        Agama::create([
            'name' => $request->name,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('admin.agama.index')->with('success', 'Agama berhasil ditambahkan');
    }

    public function edit(Agama $agama)
    {
        return view('admin.agama.edit', compact('agama'));
    }

    public function update(Request $request, Agama $agama)
    {
        if ($request->is_active == 'on' || $request->is_active == "1") {
            $request->merge(['is_active' => true]);
        } else {
            $request->merge(['is_active' => false]);
        }

        $request->validate([
            'name' => 'required|string|max:50',
            'is_active' => 'required|boolean',
        ]);

        $agama->update([
            'name' => $request->name,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('admin.agama.index')->with('success', 'Agama berhasil diperbarui');
    }

    public function destroy(Agama $agama)
    {
        $agama->delete();
        return redirect()->route('admin.agama.index')->with('success', 'Agama berhasil dihapus');
    }
}
