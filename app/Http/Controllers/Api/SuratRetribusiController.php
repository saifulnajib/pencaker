<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\SuratRetribusi;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\SuratRetribusiResource;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;
use App\Exports\SuratRetribusiExport;

class SuratRetribusiController extends ApiController
{
    
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = SuratRetribusi::filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, SuratRetribusiResource::class), 'Data retrieved successfully.');
    }
    
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama_pemohon' => 'required',
            'nama_usaha' => 'required',
            'jenis_usaha' => 'required',
            'alamat_usaha' => 'required',
            'nomor_telpon' => 'required|numeric',
            'tarif_retribusi' => 'required|numeric',
            // 'keterangan'=>'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        try {
            $data = SuratRetribusi::create($input);

            return $this->sendResponse(new SuratRetribusiResource($data), 'Data created successfully.');
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }
    
    public function show($id): JsonResponse
    {
        $data = SuratRetribusi::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new SuratRetribusiResource($data), 'Data retrieved successfully.');
    }
    
    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama_pemohon' => 'required',
            'nama_usaha' => 'required',
            'jenis_usaha' => 'required',
            'alamat_usaha' => 'required',
            'nomor_telpon' => 'required|numeric',
            'tarif_retribusi' => 'required|numeric',
            // 'keterangan'=>'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = SuratRetribusi::find($id);

        $data->nama_pemohon = $input['nama_pemohon'];
        $data->jenis_usaha = $input['jenis_usaha'];
        $data->alamat_usaha = $input['alamat_usaha'];
        $data->jenis_usaha = $input['jenis_usaha'];
        $data->nomor_telpon = $input['nomor_telpon'];
        $data->tarif_retribusi = $input['tarif_retribusi'];
        $data->keterangan = $input['keterangan'];
        $data->save();

        return $this->sendResponse(new SuratRetribusiResource($data), 'Data updated successfully.');
    }
    
    public function destroy($id): JsonResponse
    {
        $data = SuratRetribusi::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }

    public function exportSuratRetribusi(Request $request)
    {
        $tanggal = date('Y-m-d');

        if (!empty($request->query('tanggal'))) {
            $tanggal = $request->query('tanggal');
        }

        $exportTime = Carbon::parse("$tanggal")->locale('id-ID');

        $data = SuratRetribusi::all();

        $data = [
            'data' => $data,
            'time' => $exportTime->translatedFormat('l / d F Y'),
            'bulan' => Str::upper($exportTime->translatedFormat('F')),
        ];
        
        $export_name = "Data-surat-retribusi-$tanggal.xlsx";

        return Excel::download(new SuratRetribusiExport($data), $export_name);
    }
}
