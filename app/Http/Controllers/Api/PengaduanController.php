<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PengaduanResource;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;
use App\Exports\PengaduanExport;


class PengaduanController extends ApiController
{
    
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = Pengaduan::filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, PengaduanResource::class), 'Data retrieved successfully.');
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'lokasi_kejadian' => 'required',
            'nama_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
            'waktu_kejadian' => 'required',
            'uraian_kejadian' => 'required',
            'dampak' => 'required',
            'penyelesaian' => 'required',
            'status' => 'numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        try {
            $data = Pengaduan::create($input);

            return $this->sendResponse(new PengaduanResource($data), 'Data created successfully.');
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }
    
    public function show($id): JsonResponse
    {
        $data = Pengaduan::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new PengaduanResource($data), 'Data retrieved successfully.');
    }
    
    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'lokasi_kejadian' => 'required',
            'nama_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
            'waktu_kejadian' => 'required',
            'uraian_kejadian' => 'required',
            'dampak' => 'required',
            'penyelesaian' => 'required',
            'status' => 'numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Pengaduan::find($id);

        $data->nama = $input['nama'];
        $data->alamat = $input['alamat'];
        $data->no_telpon = $input['no_telpon'];
        $data->lokasi_kejadian = $input['lokasi_kejadian'];
        $data->nama_kegiatan = $input['nama_kegiatan'];
        $data->jenis_kegiatan = $input['jenis_kegiatan'];
        $data->waktu_kejadian = $input['waktu_kejadian'];
        $data->uraian_kejadian = $input['uraian_kejadian'];
        $data->dampak = $input['dampak'];
        $data->penyelesaian = $input['penyelesaian'];
        $data->status = $input['status'];
        $data->save();

        return $this->sendResponse(new PengaduanResource($data), 'Data updated successfully.');
    }
    
    public function destroy($id): JsonResponse
    {
        $data = Pengaduan::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }

    public function exportPengaduan(Request $request)
    {
        $tanggal = date('Y-m-d');

        if (!empty($request->query('tanggal'))) {
            $tanggal = $request->query('tanggal');
        }

        $exportTime = Carbon::parse("$tanggal")->locale('id-ID');

        $data = Pengaduan::all();

        $data = [
            'data' => $data,
            'time' => $exportTime->translatedFormat('l / d F Y'),
            'bulan' => Str::upper($exportTime->translatedFormat('F')),
        ];
        
        $export_name = "Data-pengaduan-$tanggal.xlsx";

        return Excel::download(new PengaduanExport($data), $export_name);
    }
}
