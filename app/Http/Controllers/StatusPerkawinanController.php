<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusPerkawinan;

class StatusPerkawinanController extends Controller
{
    public function index()
    {
        $status_perkawinan = StatusPerkawinan::all();
        return view('admin.status_perkawinan.index', compact('status_perkawinan'));
    }

    public function create()
    {
        return view('admin.status_perkawinan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        StatusPerkawinan::create($request->all());
        return redirect()->route('admin.status_perkawinan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(StatusPerkawinan $statusPerkawinan)
    {
        return view('admin.status_perkawinan.edit', compact('statusPerkawinan'));
    }

    public function update(Request $request, StatusPerkawinan $statusPerkawinan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $statusPerkawinan->update($request->all());
        return redirect()->route('admin.status_perkawinan.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(StatusPerkawinan $statusPerkawinan)
    {
        $statusPerkawinan->delete();
        return redirect()->route('admin.status_perkawinan.index')->with('success', 'Data berhasil dihapus');
    }
}
