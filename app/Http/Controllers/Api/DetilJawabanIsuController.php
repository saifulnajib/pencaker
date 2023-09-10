<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\DetilJawabanIsu;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\DetilJawabanIsuResource;

class DetilJawabanIsuController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = DetilJawabanIsu::filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, DetilJawabanIsuResource::class), 'Data retrieved successfully.');
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
            'id_jawaban_isu' => 'required',
            'id_isu' => 'required',
            'skala_pencemaran' => 'required',
            'skala_urgensi' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = DetilJawabanIsu::create($input);

        return $this->sendResponse(new DetilJawabanIsuResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = DetilJawabanIsu::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new DetilJawabanIsuResource($data), 'Data retrieved successfully.');
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
            'id_jawaban_isu' => 'required',
            'id_isu' => 'required',
            'skala_pencemaran' => 'required',
            'skala_urgensi' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = DetilJawabanIsu::find($id);

        $data->id_jawaban_isu = $input['id_jawaban_isu'];
        $data->id_isu = $input['id_isu'];
        $data->skala_pencemaran = $input['skala_pencemaran'];
        $data->skala_urgensi = $input['skala_urgensi'];
        $data->save();

        return $this->sendResponse(new DetilJawabanIsuResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = DetilJawabanIsu::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
