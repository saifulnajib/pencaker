<?php

namespace App\Http\Controllers\Api;

use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PengelolaanLimbah;
use App\Models\KegiatanUsaha;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\PengelolaanLimbahResource;
use App\Exports\PengelolaanLimbahExport;

class PengelolaanLimbahController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = PengelolaanLimbah::with(['kegiatanUsaha'])->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, PengelolaanLimbahResource::class), 'Data retrieved successfully.');
    }
    
    public function history($id): JsonResponse
    {
        $data = PengelolaanLimbah::where('id_kegiatan_usaha', $id)->orderBy('tanggal_surat','desc')->get();

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(PengelolaanLimbahResource::collection($data), 'Data retrieved successfully.');
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
            'jenis_limbah' => 'required',
            'kode_limbah' => 'required',
            'tahun' => 'numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = PengelolaanLimbah::create($input);

        return $this->sendResponse(new PengelolaanLimbahResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = PengelolaanLimbah::with(['kegiatanUsaha'])->find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new PengelolaanLimbahResource($data), 'Data retrieved successfully.');
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
            'jenis_limbah' => 'required',
            'kode_limbah' => 'required',
            'tahun' => 'numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = PengelolaanLimbah::find($id);

        $data->id_kegiatan_usaha = $input['id_kegiatan_usaha'];
        $data->jenis_limbah = $input['jenis_limbah'];
        $data->kode_limbah = $input['kode_limbah'];
        $data->perizinan = $input['perizinan'];
        $data->nomor = $input['nomor'];
        $data->tahun = $input['tahun'];
        $data->keterangan = $input['keterangan'];
        $data->save();

        return $this->sendResponse(new PengelolaanLimbahResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = PengelolaanLimbah::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }

    public function exportPengelolaanLimbah(Request $request)
    {
        $tahun = date('Y');

        if (!empty($request->query('tahun'))) {
            $tahun = $request->query('tahun');
        }

        $data = KegiatanUsaha::with(['pengelolaanLimbah'=> function($q) use($tahun, $request){
                    $q->where('tahun','<=',$tahun)->orderBy('tahun','asc');
                }])->get();

        //  return $data;
        $data = [
            'data' => $data,
        ];

        $export_name = "Rekap-SK-PengelolaanLimbah.xlsx";

        return Excel::download(new PengelolaanLimbahExport($data), $export_name);
    }
}
