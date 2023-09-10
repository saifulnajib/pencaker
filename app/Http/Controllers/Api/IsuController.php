<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\Isu;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\IsuResource;

class IsuController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = Isu::with(['dimensi'])->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, IsuResource::class), 'Data retrieved successfully.');
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
            'id_dimensi_isu' => 'required',
            'isu' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $input['id_penjaringan_isu'] = 1;
        $data = Isu::create($input);

        return $this->sendResponse(new IsuResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = Isu::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new IsuResource($data), 'Data retrieved successfully.');
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
            'id_dimensi_isu' => 'required',
            'isu' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Isu::find($id);

        $data->id_dimensi_isu = $input['id_dimensi_isu'];
        $data->isu = $input['isu'];
        $data->justifikasi_pencemaran = $input['justifikasi_pencemaran'] ?? '';
        $data->justifikasi_urgensi = $input['justifikasi_urgensi'] ?? '';
        $data->kaitan_isu_rpjmd = $input['kaitan_isu_rpjmd'] ?? '';
        $data->kaitan_isu_klhs = $input['kaitan_isu_klhs'] ?? '';
        $data->kaitan_isu_tpb = $input['kaitan_isu_tpb'] ?? '';
        $data->save();

        return $this->sendResponse(new IsuResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = Isu::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
