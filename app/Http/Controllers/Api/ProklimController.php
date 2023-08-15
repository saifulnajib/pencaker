<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use App\Models\Proklim;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ProklimResource;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;

class ProklimController extends ApiController
{
    
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = Proklim::with(['kategoriProklim'])->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, ProklimResource::class), 'Data retrieved successfully.');
    }
    
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama' => 'required',
            'id_kategori' => 'required',
            'alamat' => 'required',
            'no_registrasi' => 'required',
            'tahun_proklim' => 'required',
            'kode_wilayah' => 'required',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
            'is_active' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        try {
            $data = Proklim::create($input);

            return $this->sendResponse(new ProklimResource($data), 'Data created successfully.');
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }
    
    public function show($id): JsonResponse
    {
        $data = Proklim::with(['kategoriProklim'])->find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new ProklimResource($data), 'Data retrieved successfully.');
    }
    
    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama' => 'required',
            'id_kategori' => 'required',
            'alamat' => 'required',
            'no_registrasi' => 'required',
            'tahun_proklim' => 'required',
            'kode_wilayah' => 'required',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
            'is_active' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Proklim::find($id);

        $data->nama = $input['nama'];
        $data->id_kategori = $input['id_kategori'];
        $data->alamat = $input['alamat'];
        $data->no_registrasi = $input['no_registrasi'];
        $data->tahun_proklim = $input['tahun_proklim'];
        $data->kode_wilayah = $input['kode_wilayah'];
        $data->latitude = $input['latitude'];
        $data->longitude = $input['longitude'];
        $data->is_active = $input['is_active'];
        $data->save();

        return $this->sendResponse(new ProklimResource($data), 'Data updated successfully.');
    }
    
    public function destroy($id): JsonResponse
    {
        $data = Proklim::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
