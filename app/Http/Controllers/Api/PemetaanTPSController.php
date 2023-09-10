<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use App\Models\TitikKoordinat;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\TitikKoordinatResource;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;

class PemetaanTPSController extends ApiController
{

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = TitikKoordinat::where('jenis','tps')->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, TitikKoordinatResource::class), 'Data retrieved successfully.');
    }
    
    public function pemetaan(Request $request): JsonResponse
    {
        $data = TitikKoordinat::where('jenis','tps')->get();
        return $this->sendResponse(TitikKoordinatResource::collection($data), 'Data retrieved successfully.');
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama_lokasi' => 'required',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        try {
            $input['jenis'] = 'tps';
            $data = TitikKoordinat::create($input);

            return $this->sendResponse(new TitikKoordinatResource($data), 'Data created successfully.');
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }

    public function show($id): JsonResponse
    {
        $data = TitikKoordinat::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new TitikKoordinatResource($data), 'Data retrieved successfully.');
    }

    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama_lokasi' => 'required',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = TitikKoordinat::find($id);

        $data->nama_lokasi = $input['nama_lokasi'];
        $data->alamat = $input['alamat'];
        $data->jenis = 'tps';
        $data->latitude = $input['latitude'];
        $data->longitude = $input['longitude'];
        $data->save();

        return $this->sendResponse(new TitikKoordinatResource($data), 'Data updated successfully.');
    }

    public function destroy($id): JsonResponse
    {
        $data = TitikKoordinat::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
