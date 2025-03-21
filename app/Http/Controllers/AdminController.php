<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Pastikan model User sudah ada

class AdminController extends Controller
{
    // Metode untuk menampilkan dashboard admin
    public function dashboard()
    {
        // Ambil data user yang berperan sebagai admin, misalnya berdasarkan kolom 'role'
        $adminUsers = User::where('role', 'admin')->get();
        
        // Kirim data ke view dashboard
        return view('admin.dashboard', compact('adminUsers'));
    }
}
