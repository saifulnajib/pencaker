<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\BankSampah;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\BankSampahResource;
use App\Http\Resources\TitikKoordinatResource;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;
use App\Exports\BankSampahExport;


class BankSampahController extends ApiController
{
    
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = BankSampah::filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, BankSampahResource::class), 'Data retrieved successfully.');
    }
    
    public function pemetaan(Request $request): JsonResponse
    {
        $data = BankSampah::all();
        return $this->sendResponse(TitikKoordinatResource::collection($data), 'Data retrieved successfully.');
    }
    
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama' => 'required',
            'alamat' => 'required',
            'kode_wilayah' => 'required',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
            'status_pengajuan' => 'required',
            'nomor_telpon' => 'required',
            'is_active' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        if ($request->hasFile('file_surat_pengajuan')) {
            $file = $request->file('file_surat_pengajuan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/banksampah', $filename); // storage/app/public

            $input['file_surat_pengajuan'] = 'uploads/banksampah/'.$filename;
        }else{
            return response()->json(['message' => 'File surat pengajuan harus diunggah'], 400);
        }

        try {
            $data = BankSampah::create($input);

            return $this->sendResponse(new BankSampahResource($data), 'Data created successfully.');
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }
    
    public function show($id): JsonResponse
    {
        $data = BankSampah::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new BankSampahResource($data), 'Data retrieved successfully.');
    }
    
    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama' => 'required',
            'alamat' => 'required',
            'kode_wilayah' => 'required',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
            'status_pengajuan' => 'required',
            'nomor_telpon' => 'required',
            'is_active' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = BankSampah::find($id);

        if ($request->hasFile('file_surat_pengajuan')) {
            $file = $request->file('file_surat_pengajuan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/banksampah', $filename); // storage/app/public

            $data->file_surat_pengajuan = 'uploads/banksampah/'.$filename;
        }


        $data->nama = $input['nama'];
        $data->alamat = $input['alamat'];
        $data->kode_wilayah = $input['kode_wilayah'];
        $data->latitude = $input['latitude'];
        $data->longitude = $input['longitude'];
        $data->status_pengajuan = $input['status_pengajuan'];
        $data->nomor_telpon = $input['nomor_telpon'];
        $data->is_active = $input['is_active'];
        $data->save();

        return $this->sendResponse(new BankSampahResource($data), 'Data updated successfully.');
    }
    
    public function destroy($id): JsonResponse
    {
        $data = BankSampah::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }

    public function exportBankSampah(Request $request)
    {
        $tanggal = date('Y-m-d');

        if (!empty($request->query('tanggal'))) {
            $tanggal = $request->query('tanggal');
        }

        $exportTime = Carbon::parse("$tanggal")->locale('id-ID');

        $data = BankSampah::all();

        $data = [
            'data' => $data,
            'time' => $exportTime->translatedFormat('l / d F Y'),
            'bulan' => Str::upper($exportTime->translatedFormat('F')),
        ];
        
        $export_name = "Data-bank-sampah-$tanggal.xlsx";

        return Excel::download(new BankSampahExport($data), $export_name);
    }
}
