<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Lamaran;
use Illuminate\Support\Facades\Auth;

class PencakerController extends Controller
{
    public function index()
    {
        $lowonganTerbaru = Lowongan::latest()->take(5)->get(); // Ambil 5 lowongan terbaru
        $lamaranSaya = Lamaran::where('user_id', Auth::id())->get();

        return view('pencaker.dashboard', compact('lowonganTerbaru', 'lamaranSaya'));
    }
}
