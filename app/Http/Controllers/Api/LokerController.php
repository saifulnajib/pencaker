<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Illuminate\Http\Request;
use App\Models\Loker;
use App\Models\Perusahaan;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\LokerResource;

class LokerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = request()->query('size', 10);
        $data = Loker::filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, LokerResource::class), 'Data retrieved successfully.');
    }

    /**
     * Display a listing of the resource for dropdown.
     *
     * @return \Illuminate\Http\JsonResponse
     */

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
            'id_perusahaan' => 'required',
            'posisi' => 'required',
            'deskripsi' => 'required',
            'kualifikasi' => 'required',
            'lokasi' => 'required',
            'gaji' => 'required',
            'expired' => 'required',
            'is_active' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Loker::create($input);

        return $this->sendResponse(new LokerResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = Loker::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new LokerResource($data), 'Data retrieved successfully.');
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
            'id_perusahaan' => 'required',
            'posisi' => 'required',
            'deskripsi' => 'required',
            'kualifikasi' => 'required',
            'lokasi' => 'required',
            'gaji' => 'required',
            'expired' => 'required',
            'is_active' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Loker::find($id);

        $data->id_perusahaan = $input['id_perusahaan'];
        $data->posisi = $input['posisi'];
        $data->deskripsi = $input['deskripsi'];
        $data->kualifikasi = $input['kualifikasi'];
        $data->lokasi = $input['lokasi'];
        $data->gaji = $input['gaji'];
        $data->expired = $input['expired'];
        $data->is_active = $input['is_active'];
        $data->save();

        return $this->sendResponse(new LokerResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = Loker::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
