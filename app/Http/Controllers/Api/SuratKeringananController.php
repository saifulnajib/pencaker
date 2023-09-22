<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use App\Models\SuratKeringanan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\SuratKeringananResource;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;

class SuratKeringananController extends ApiController
{
    
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = SuratKeringanan::filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, SuratKeringananResource::class), 'Data retrieved successfully.');
    }
    
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama_usaha' => 'required',
            'jenis_bangunan' => 'required',
            'nama_penanggungjawab' => 'required',
            'nik' => 'required|numeric',
            'nomor_telpon' => 'required',
            'tarif_perda' => 'required|numeric',
            'tarif_keringanan' => 'required|numeric',
            'alasan' => 'required',
            'alamat' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/suratkeringanan', $filename); // storage/app/public

            $input['file_surat'] = 'uploads/suratkeringanan/'.$filename;
        }

        try {
            $data = SuratKeringanan::create($input);

            return $this->sendResponse(new SuratKeringananResource($data), 'Data created successfully.');
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }
    
    public function show($id): JsonResponse
    {
        $data = SuratKeringanan::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new SuratKeringananResource($data), 'Data retrieved successfully.');
    }
    
    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama_usaha' => 'required',
            'jenis_bangunan' => 'required',
            'nama_penanggungjawab' => 'required',
            'nik' => 'required|numeric',
            'nomor_telpon' => 'required',
            'tarif_perda' => 'required|numeric',
            'tarif_keringanan' => 'required|numeric',
            'alasan' => 'required',
            'alamat' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = SuratKeringanan::find($id);

        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/suratkeringanan', $filename); // storage/app/public

            $data->file_surat = 'uploads/suratkeringanan/'.$filename;
        }

        $data->nama_usaha = $input['nama_usaha'];
        $data->jenis_bangunan = $input['jenis_bangunan'];
        $data->nama_penanggungjawab = $input['nama_penanggungjawab'];
        $data->nik = $input['nik'];
        $data->nomor_telpon = $input['nomor_telpon'];
        $data->tarif_perda = $input['tarif_perda'];
        $data->tarif_keringanan = $input['tarif_keringanan'];
        $data->alasan = $input['alasan'];
        $data->alamat = $input['alamat'];
        $data->keterangan = $input['keterangan'];
        $data->save();

        return $this->sendResponse(new SuratKeringananResource($data), 'Data updated successfully.');
    }
    
    public function destroy($id): JsonResponse
    {
        $data = SuratKeringanan::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
