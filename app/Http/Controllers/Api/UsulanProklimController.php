<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use App\Models\UsulanProklim;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UsulanProklimResource;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;

class UsulanProklimController extends ApiController
{
    
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = UsulanProklim::filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, UsulanProklimResource::class), 'Data retrieved successfully.');
    }
    
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama' => 'required',
            'alamat' => 'required',
            'kode_wilayah' => 'required',
            'nama_ketua' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        try {
            $data = UsulanProklim::create($input);

            return $this->sendResponse(new UsulanProklimResource($data), 'Data created successfully.');
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }
    
    public function show($id): JsonResponse
    {
        $data = UsulanProklim::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new UsulanProklimResource($data), 'Data retrieved successfully.');
    }
    
    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama' => 'required',
            'alamat' => 'required',
            'kode_wilayah' => 'required',
            'nama_ketua' => 'required',
            'status_usulan' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = UsulanProklim::find($id);

        $data->nama = $input['nama'];
        $data->alamat = $input['alamat'];
        $data->kode_wilayah = $input['kode_wilayah'];
        $data->nama_ketua = $input['nama_ketua'];
        $data->status_usulan = $input['status_usulan'];
        $data->save();

        return $this->sendResponse(new UsulanProklimResource($data), 'Data updated successfully.');
    }
    
    public function destroy($id): JsonResponse
    {
        $data = UsulanProklim::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
