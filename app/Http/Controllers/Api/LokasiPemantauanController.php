<?php

namespace App\Http\Controllers\Api;

use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\LokasiPemantauan;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\LokasiPemantauanResource;
use App\Http\Resources\HasilPemantauanResource;
use App\Exports\LokasiPemantauanBulananExport;

class LokasiPemantauanController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = LokasiPemantauan::with(['kegiatanUsaha'])->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, LokasiPemantauanResource::class), 'Data retrieved successfully.');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function hasil(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = LokasiPemantauan::with(['kegiatanUsaha'])->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, HasilPemantauanResource::class), 'Data retrieved successfully.');
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
            'tanggal_pemantauan' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'is_kualitas_udara' => 'required',
            'is_kualitas_air_limbah' => 'required',
            'parameter_iku' => 'array',
            'parameter_ika' => 'array',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = LokasiPemantauan::create($input);

        return $this->sendResponse(new LokasiPemantauanResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = LokasiPemantauan::with(['kegiatanUsaha'])->find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new LokasiPemantauanResource($data), 'Data retrieved successfully.');
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
            'tanggal_pemantauan' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'is_kualitas_udara' => 'required',
            'is_kualitas_air_limbah' => 'required',
            'parameter_iku' => 'array',
            'parameter_ika' => 'array',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = LokasiPemantauan::find($id);

        $data->id_kegiatan_usaha = $input['id_kegiatan_usaha'];
        $data->tanggal_pemantauan = $input['tanggal_pemantauan'];
        $data->latitude = $input['latitude'];
        $data->longitude = $input['longitude'];
        $data->is_kualitas_udara = $input['is_kualitas_udara'];
        $data->is_kualitas_air_limbah = $input['is_kualitas_air_limbah'];
        $data->parameter_iku = $input['parameter_iku'];
        $data->parameter_ika = $input['parameter_ika'];
        $data->save();

        return $this->sendResponse(new LokasiPemantauanResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = LokasiPemantauan::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }

    public function exportLokasiPemantauanBulanan(Request $request)
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

        $data_pantau = LokasiPemantauan::with(['kegiatanUsaha'])->whereMonth('tanggal_pemantauan',$bulan)->whereYear('tanggal_pemantauan',$tahun)->orderBy('tanggal_pemantauan','asc')->get();

        $data = [
            'data' => $data_pantau,
            'time' => $exportTime->translatedFormat('l / d F Y'),
            'bulan' => Str::upper($dataTime->translatedFormat('F')),
            'tahun' => $tahun,
        ];

        $export_name = "Laporan-bulanan-lokasi-pemantauan-".$data['bulan'].".xlsx";

        return Excel::download(new LokasiPemantauanBulananExport($data), $export_name);
    }
}
