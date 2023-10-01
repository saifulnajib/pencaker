<?php

namespace App\Http\Controllers\Api;

use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Sanksi;
use App\Models\KegiatanUsaha;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\SanksiResource;
use App\Exports\SanksiExport;

class SanksiController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = Sanksi::with(['kegiatanUsaha'])->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, SanksiResource::class), 'Data retrieved successfully.');
    }
    
    public function history($id): JsonResponse
    {
        $data = Sanksi::where('id_kegiatan_usaha', $id)->orderBy('tanggal_surat','desc')->get();

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(SanksiResource::collection($data), 'Data retrieved successfully.');
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
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required',
            'alasan' => 'required',
            'perintah' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Sanksi::create($input);

        return $this->sendResponse(new SanksiResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = Sanksi::with(['kegiatanUsaha'])->find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new SanksiResource($data), 'Data retrieved successfully.');
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
            'nomor_surat' => 'required',
            'tanggal_surat' => 'required',
            'alasan' => 'required',
            'perintah' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Sanksi::find($id);

        $data->id_kegiatan_usaha = $input['id_kegiatan_usaha'];
        $data->nomor_surat = $input['nomor_surat'];
        $data->tanggal_surat = $input['tanggal_surat'];
        $data->alasan = $input['alasan'];
        $data->perintah = $input['perintah'];
        $data->status = $input['status'];
        $data->keterangan = $input['keterangan'];
        $data->save();

        return $this->sendResponse(new SanksiResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = Sanksi::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }

    public function exportSanksi(Request $request)
    {
        $tahun = date('Y');

        if (!empty($request->query('tahun'))) {
            $tahun = $request->query('tahun');
        }

        $data = Sanksi::with(['kegiatanUsaha'])->when($request->has('tahun'), function ($query) use ($tahun) {
            $query->whereYear('tanggal_surat','<=',$tahun);
        })->orderBy('tanggal_surat','asc')->get();

        // return $data_pantau;
        $data = [
            'data' => $data,
        ];

        $export_name = "Rekap-SK-Sanksi.xlsx";

        return Excel::download(new SanksiExport($data), $export_name);
    }
}
