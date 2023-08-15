<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use App\Models\BankSampah;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\BankSampahResource;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;

class BankSampahController extends ApiController
{
    
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = BankSampah::filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, BankSampahResource::class), 'Data retrieved successfully.');
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
            'is_active' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
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
            'is_active' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = BankSampah::find($id);

        $data->nama = $input['nama'];
        $data->alamat = $input['alamat'];
        $data->kode_wilayah = $input['kode_wilayah'];
        $data->latitude = $input['latitude'];
        $data->longitude = $input['longitude'];
        $data->status_pengajuan = $input['status_pengajuan'];
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
}
