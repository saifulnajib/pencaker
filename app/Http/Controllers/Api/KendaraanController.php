<?php

namespace App\Http\Controllers\Api;

use Validator;
use Carbon\Carbon;
use App\Models\Kendaraan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TrukSampahHarianExport;
use App\Http\Resources\KendaraanResource;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;

class KendaraanController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = Kendaraan::with(['jenisKendaraan','ruteKendaraan'])->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, KendaraanResource::class), 'Data retrieved successfully.');
    }

    /**
     * Display a listing of the resource for dropdown.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function option(Request $request): JsonResponse
    {
        $data = Kendaraan::select('id', DB::raw("CONCAT(nopol,' - ',sopir) as name"))->where('is_active', 1)->latest('updated_at')->get();
        return $this->sendResponse($data, 'Data retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nopol' => 'required',
            'sopir' => 'required',
            'jenis_kendaraan' => 'required',
            'rute' => 'required',
            'is_active' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Kendaraan::create($input);

        return $this->sendResponse(new KendaraanResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = Kendaraan::with(['jenisKendaraan','ruteKendaraan'])->find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new KendaraanResource($data), 'Data retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nopol' => 'required',
            'sopir' => 'required',
            'jenis_kendaraan' => 'required',
            'rute' => 'required',
            'is_active' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Kendaraan::find($id);

        $data->nopol = $input['nopol'];
        $data->sopir = $input['sopir'];
        $data->jenis_kendaraan = $input['jenis_kendaraan'];
        $data->rute = $input['rute'];
        $data->is_active = $input['is_active'];
        $data->save();

        return $this->sendResponse(new KendaraanResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = Kendaraan::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }

    public function exportTrukSampahHarian(Request $request)
    {
        $tanggal = date('Y-m-d');

        if (!empty($request->query('tanggal'))) {
            $tanggal = $request->query('tanggal');
        }

        $exportTime = Carbon::parse("$tanggal")->locale('id-ID');

        $data_truk = Kendaraan::leftJoin('sampah', function($join) use ($tanggal) {
                        $join->on('kendaraan.id', '=', 'sampah.id_kendaraan')
                        ->whereDate('sampah.waktu_masuk', '=', $tanggal);
                    })->with(['jenisKendaraan', 'ruteKendaraan', 'sampahMasuk' => function ($query) use ($tanggal) {
                        $query->whereDate('waktu_masuk', $tanggal)->orderBy('waktu_masuk', 'asc');
                    }])->select('kendaraan.*')->get();

        $data = [
            'data' => $data_truk,
            'time' => $exportTime->translatedFormat('l / d F Y'),
            'bulan' => Str::upper($exportTime->translatedFormat('F')),
            'ttd' => [
                'lokasi' => "Tanjungpinang",
                'waktu' => $exportTime->translatedFormat('d F Y'),
                'jabatan' => "Kepala UPTD TPA",
                'nama_pejabat' => "M. RIPAYANDI PUTRA, S.E",
                'nip_pejabat' => "19731125 2000604 1 006",
            ],
        ];

        $export_name = "Laporan-truk-sampah-masuk-harian-$tanggal.xlsx";

        return Excel::download(new TrukSampahHarianExport($data), $export_name);
    }

    public function exportTrukSampahBulanan(Request $request)
    {
        $tahun = date('Y');
        $bulan = date('m');
        $tanggal = date('Y-m-d');

        if (!empty($request->query('tahun'))) {
            $tahun = $request->query('tahun');
        }

        if (!empty($request->query('bulan'))) {
            $bulan = $request->query('bulan');
        }

        $exportTime = Carbon::parse("$tanggal")->locale('id-ID');
        $dataTime = Carbon::parse("$tahun-$bulan-01")->locale('id-ID');

        $data_truk = Kendaraan::with(['sampahMasuk' => function ($query) use ($bulan, $tahun) {
            $query->whereMonth('sampah.waktu_masuk', '=', $bulan)
            ->whereYear('sampah.waktu_masuk', '=', $tahun);
        }])->get();

        $data = [
            'data' => $data_truk,
            'time' => $exportTime->translatedFormat('l / d F Y'),
            'bulan' => Str::upper($dataTime->translatedFormat('F')),
            'tahun' => $dataTime->translatedFormat('Y'),
            'ttd' => [
                'lokasi' => "Tanjungpinang",
                'waktu' => $exportTime->translatedFormat('d F Y'),
                'jabatan' => "Kepala UPTD TPA",
                'nama_pejabat' => "M. RIPAYANDI PUTRA, S.E",
                'nip_pejabat' => "19731125 2000604 1 006",
            ],
        ];

        $export_name = "Laporan-truk-sampah-masuk-bulan-".$data['bulan']."-".$data['tahun'].".xlsx";

        return Excel::download(new TrukSampahBulananExport($data), $export_name);
    }
}
