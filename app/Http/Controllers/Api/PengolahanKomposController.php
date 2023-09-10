<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use App\Models\PengolahanKompos;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PengolahanKomposResource;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;

class PengolahanKomposController extends ApiController
{
    
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = PengolahanKompos::with(['kendaraan'])->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, PengolahanKomposResource::class), 'Data retrieved successfully.');
    }
    
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id_kendaraan' => 'required',
            'waktu_masuk' => 'required',
            'berat_masuk' => 'required|numeric',
            'berat_keluar' => 'numeric',
            'kompos_keluar' => 'numeric',
            //'keterangan'=>'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        try {
           // $input['berat_isi'] = $input['berat_masuk'] - $input['berat_keluar'];
            $data = PengolahanKompos::create($input);

            return $this->sendResponse(new PengolahanKomposResource($data), 'Data created successfully.');
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }
    
    public function show($id): JsonResponse
    {
        $data = PengolahanKompos::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new PengolahanKomposResource($data), 'Data retrieved successfully.');
    }
    
    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id_kendaraan' => 'required',
            'waktu_masuk' => 'required',
            'waktu_keluar' => 'required',
            'berat_masuk' => 'required|numeric',
            'berat_keluar' => 'required|numeric',
            'kompos_keluar' => 'required|numeric',
            //'keterangan'=>'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = PengolahanKompos::find($id);

        $data->id_kendaraan = $input['id_kendaraan'];
        $data->waktu_masuk = $input['waktu_masuk'];
        $data->waktu_keluar = $input['waktu_keluar'];
        $data->berat_masuk = $input['berat_masuk'];
        $data->berat_keluar = $input['berat_keluar'];
        $data->berat_isi = $input['berat_masuk'] - $input['berat_keluar'];
        $data->kompos_keluar = $input['kompos_keluar'];
        $data->keterangan = $input['keterangan'];
        $data->save();

        return $this->sendResponse(new PengolahanKomposResource($data), 'Data updated successfully.');
    }
    
    public function destroy($id): JsonResponse
    {
        $data = PengolahanKompos::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
