<?php

namespace App\Http\Controllers\Api;

use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\RiwayatCuti;
use App\Models\Pegawai;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\RiwayatCutiResource;
use App\Exports\RiwayatCutiExport;

class RiwayatCutiController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = RiwayatCuti::with(['dataPegawai'])->orderBy('tanggal_mulai','desc')->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, RiwayatCutiResource::class), 'Data retrieved successfully.');
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
            'kategori_cuti' => 'required',
            'alasan_cuti' => 'required',
            'tanggal_mulai' => 'required',
            'lama' => 'numeric|required',
            'sisa' => 'numeric|required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = RiwayatCuti::create($input);

        return $this->sendResponse(new RiwayatCutiResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = RiwayatCuti::with(['dataPegawai'])->find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new RiwayatCutiResource($data), 'Data retrieved successfully.');
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
            'kategori_cuti' => 'required',
            'alasan_cuti' => 'required',
            'tanggal_mulai' => 'required',
            'lama' => 'required',
            'sisa' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = RiwayatCuti::find($id);

        $data->id_pegawai = $input['id_pegawai'];
        $data->kategori_cuti = $input['kategori_cuti'];
        $data->alasan_cuti = $input['alasan_cuti'];
        $data->tanggal_mulai = $input['tanggal_mulai'];
        $data->tanggal_selesai = $input['tanggal_selesai'];
        $data->lama = $input['lama'];
        $data->sisa = $input['sisa'];
        $data->save();

        return $this->sendResponse(new RiwayatCutiResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = RiwayatCuti::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }

    public function exportRiwayatCuti(Request $request)
    {
        $tahun = date('Y');

        if (!empty($request->query('tahun'))) {
            $tahun = $request->query('tahun');
        }

        $data = RiwayatCuti::with(['dataPegawai'])->orderBy('tanggal_mulai','desc')->get();

        $data = [
            'data' => $data,
        ];

        $export_name = "Rekap-Riwayat-Cuti.xlsx";

        return Excel::download(new RiwayatCutiExport($data), $export_name);
    }
}
