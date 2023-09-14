<?php

namespace App\Http\Controllers\Api;

use App\Models\BankSampah;
use App\Models\PemilahanSampah;
use App\Models\Sampah;
use App\Models\PengolahanKompos;
use App\Models\PenyedotanTinja;
use App\Models\SuratRetribusi;
use App\Models\UsulanProklim;
use App\Models\Kendaraan;
use Spatie\Activitylog\Models\Activity;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\DashboardResource;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;


class DashboardController extends ApiController
{
    
    public function index(Request $request): JsonResponse
    {
        $data = [
            "sampah_masuk" => (Sampah::select('berat_sampah')->sum('berat_sampah') ?? 0).' kg',
            "pemilahan_sampah" => (PemilahanSampah::select('berat_sampah')->sum('berat_sampah') ?? 0).' kg',
            "kompos_keluar" => (PengolahanKompos::select('kompos_keluar')->sum('kompos_keluar') ?? 0).' kg',
            "penyedotan_tinja" => PenyedotanTinja::all()->count() ?? 0,
            "permohonan_skrd" => SuratRetribusi::all()->count() ?? 0,
            "bank_sampah" => BankSampah::all()->count() ?? 0,
            "permohonan_proklim" => UsulanProklim::all()->count() ?? 0,
            "kendaraan" => Kendaraan::all()->count() ?? 0,
        ];
        return $this->sendResponse(new DashboardResource($data), 'Data retrieved successfully.');
    }



    public function logs(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = Activity::paginate($perPage);
        // $logs = Activity::all();
        return $this->sendResponse($data, 'Logs data retrieved successfully.');
    }
}
