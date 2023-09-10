<?php

namespace App\Http\Controllers\Api;

use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Pengawasan;
use App\Models\KegiatanUsaha;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\PengawasanResource;
use App\Exports\PelaksanaanPengawasanExport;
use App\Exports\PelaksanaanPengawasanRinciExport;

class PengawasanController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = Pengawasan::with(['kegiatanUsaha'])->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, PengawasanResource::class), 'Data retrieved successfully.');
    }
    
    public function history($id): JsonResponse
    {
        $data = Pengawasan::where('id_kegiatan_usaha', $id)->orderBy('tanggal_pengawasan','desc')->get();

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(PengawasanResource::collection($data), 'Data retrieved successfully.');
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
            'id_kegiatan_usaha' => 'required',
            'tanggal_pengawasan' => 'required',
            'temuan_pengawasan' => 'required',
            'surat_tindaklanjut' => 'required',
            'rekomendasi_hasil_pengawasan' => 'required',
            'batas_waktu_tindaklanjut' => 'required',
            'tindaklanjut_usaha' => 'required',
            'status_pengawasan' => 'required|numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Pengawasan::create($input);

        return $this->sendResponse(new PengawasanResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = Pengawasan::with(['kegiatanUsaha'])->find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new PengawasanResource($data), 'Data retrieved successfully.');
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
            'id_kegiatan_usaha' => 'required',
            'tanggal_pengawasan' => 'required',
            'temuan_pengawasan' => 'required',
            'surat_tindaklanjut' => 'required',
            'rekomendasi_hasil_pengawasan' => 'required',
            'batas_waktu_tindaklanjut' => 'required',
            'tindaklanjut_usaha' => 'required',
            'status_pengawasan' => 'required|numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Pengawasan::find($id);

        $data->id_kegiatan_usaha = $input['id_kegiatan_usaha'];
        $data->tanggal_pengawasan = $input['tanggal_pengawasan'];
        $data->temuan_pengawasan = $input['temuan_pengawasan'];
        $data->surat_tindaklanjut = $input['surat_tindaklanjut'];
        $data->rekomendasi_hasil_pengawasan = $input['rekomendasi_hasil_pengawasan'];
        $data->batas_waktu_tindaklanjut = $input['batas_waktu_tindaklanjut'];
        $data->tindaklanjut_usaha = $input['tindaklanjut_usaha'];
        $data->status_pengawasan = $input['status_pengawasan'];
        $data->save();

        return $this->sendResponse(new PengawasanResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = Pengawasan::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }

    public function exportPelaksanaanPengawasan()
    {
        $data_pantau = KegiatanUsaha::with(['sektorKegiatan','pelaksanaanPengawasan'])->get();

        // return $data_pantau;
        $data = [
            'data' => $data_pantau,
        ];

        $export_name = "Laporan-pelaksanaan-pengawasan.xlsx";

        return Excel::download(new PelaksanaanPengawasanExport($data), $export_name);
    }

    public function exportPelaksanaanPengawasanRinci(Request $request)
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
        $data_pengawasan = Pengawasan::with(['kegiatanUsaha'])->whereMonth('tanggal_pengawasan',$bulan)->whereYear('tanggal_pengawasan',$tahun)->get();


        $exportTime = Carbon::parse("$tanggal")->locale('id-ID');
        $dataTime = Carbon::parse("$tahun-$bulan-01")->locale('id-ID');

        $data = [
            'data' => $data_pengawasan,
            'time' => $exportTime->translatedFormat('l / d F Y'),
            'bulan' => Str::upper($dataTime->translatedFormat('F')),
            'tahun' => $dataTime->translatedFormat('Y'),
        ];

        $export_name = "Laporan-pelaksanaan-pengawasan-rinci.xlsx";

        return Excel::download(new PelaksanaanPengawasanRinciExport($data), $export_name);
    }
}
