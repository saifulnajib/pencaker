<?php

namespace App\Http\Controllers\Api;

use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\RiwayatKgb;
use App\Models\Pegawai;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\RiwayatKgbResource;
use App\Exports\RiwayatKgbExport;

class RiwayatKgbController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = RiwayatKgb::with(['dataPegawai'])->orderBy('tanggal_kgb','desc')->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, RiwayatKgbResource::class), 'Data retrieved successfully.');
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
            'id_pegawai' => 'required',
            'no_kgb' => 'required',
            'tanggal_kgb' => 'required',
            'tanggal_berakhir_kgb' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = RiwayatKgb::create($input);

        return $this->sendResponse(new RiwayatKgbResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = RiwayatKgb::with(['dataPegawai'])->find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new RiwayatKgbResource($data), 'Data retrieved successfully.');
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
            'id_pegawai' => 'required',
            'no_kgb' => 'required',
            'tanggal_kgb' => 'required',
            'tanggal_berakhir_kgb' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = RiwayatKgb::find($id);

        $data->id_pegawai = $input['id_pegawai'];
        $data->no_kgb = $input['no_kgb'];
        $data->tanggal_kgb = $input['tanggal_kgb'];
        $data->tanggal_berakhir_kgb = $input['tanggal_berakhir_kgb'];
        $data->keterangan = $input['keterangan'];
        $data->save();

        return $this->sendResponse(new RiwayatKgbResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = RiwayatKgb::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }

    public function exportRiwayatKgb(Request $request)
    {
        $tahun = date('Y');

        if (!empty($request->query('tahun'))) {
            $tahun = $request->query('tahun');
        }

        $data = RiwayatKgb::with(['dataPegawai'])->orderBy('tanggal_kgb','desc')->get();

        $data = [
            'data' => $data,
        ];

        $export_name = "Rekap-Riwayat-Kgb.xlsx";

        return Excel::download(new RiwayatKgbExport($data), $export_name);
    }
}
