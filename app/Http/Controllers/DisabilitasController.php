<?php
namespace App\Http\Controllers;

use App\Models\Disabilitas; // Model yang benar
use Illuminate\Http\Request;

class DisabilitasController extends Controller
{
    public function index()
    {
        $disabilitas = Disabilitas::all();
        return view('admin.disabilitas.index', compact('disabilitas'));
    }

    public function create()
    {
        return view('admin.disabilitas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        Disabilitas::create($request->all());

        return redirect()->route('admin.disabilitas.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Disabilitas $disabilitas)
    {
        return view('admin.disabilitas.edit', compact('disabilitas'));
    }

    public function update(Request $request, Disabilitas $disabilitas)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $disabilitas->update($request->all());

        return redirect()->route('admin.disabilitas.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Disabilitas $disabilitas)
    {
        $disabilitas->delete();
        return redirect()->route('admin.disabilitas.index')->with('success', 'Data berhasil dihapus!');
    }
}
