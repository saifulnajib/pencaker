<?php
namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\Loker;
use App\Models\PermohonanAK1;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil jumlah perusahaan
        $jumlah_perusahaan = Perusahaan::count();

        // Ambil jumlah loker
        $jumlah_loker = Loker::count();

        // Ambil jumlah permohonan AK1
        $jumlah_permohonan_ak1 = PermohonanAK1::count();

        // Ambil jumlah AK1 yang sudah terverifikasi
        $jumlah_ak1_terverifikasi = PermohonanAK1::where('is_verified', 1)->count();
        $jumlah_ak1_belum_terverifikasi = PermohonanAK1::where('is_verified', 0)->count();

        // Kirim data ke view
        return view('admin.dashboard', [
            'jumlah_perusahaan' => $jumlah_perusahaan,
            'jumlah_loker' => $jumlah_loker,
            'jumlah_permohonan_ak1' => $jumlah_permohonan_ak1,
            'jumlah_ak1_terverifikasi' => $jumlah_ak1_terverifikasi,
            'jumlah_ak1_belum_terverifikasi' => $jumlah_ak1_belum_terverifikasi,
        ]);
        
    }
}