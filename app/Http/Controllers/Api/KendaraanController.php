<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\KendaraanResource;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\KendaraanCollection;

class KendaraanController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $per_page = $request->query('size', 10);
        $sort = $request->query('sort');
        $filter = $request->query('filter');
        $data = Kendaraan::with(['jenisKendaraan','ruteKendaraan']);
        if($filter) {
            foreach($filter as $fn){
                if($fn['value']) {
                    $fn['value'] = $fn['type'] == "like" ? '%'.$fn['value'].'%' : $fn['value'];
                    $data = $data->where($fn['field'], $fn['type'], $fn['value']);
                }
            }
        }
        if($sort) {
            foreach($sort as $fn){
                $data = $data->orderBy($fn['field'], $fn['dir']);
            }
        } else {
            $data = $data->latest('updated_at');
        }
        $data = $data->paginate($per_page);
        return $this->sendResponse(new KendaraanCollection($data), 'Data retrieved successfully.');
    }

    /**
     * Display a listing of the resource for dropdown.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function option(Request $request): JsonResponse
    {
        $data = Kendaraan::select('id', DB::raw("CONCAT(nopol,' - ',sopir) as name"))->where('is_active', 1)->latest('updated_at')->get();
        return $this->sendResponse($data, 'Data retrieved successfully.');
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
            'nopol' => 'required',
            'sopir' => 'required',
            'jenis_kendaraan' => 'required',
            'rute' => 'required',
            'is_active' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Kendaraan::create($input);

        return $this->sendResponse(new KendaraanResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = Kendaraan::with(['jenisKendaraan','ruteKendaraan'])->find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new KendaraanResource($data), 'Data retrieved successfully.');
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
            'nopol' => 'required',
            'sopir' => 'required',
            'jenis_kendaraan' => 'required',
            'rute' => 'required',
            'is_active' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Kendaraan::find($id);

        $data->nopol = $input['nopol'];
        $data->sopir = $input['sopir'];
        $data->jenis_kendaraan = $input['jenis_kendaraan'];
        $data->rute = $input['rute'];
        $data->is_active = $input['is_active'];
        $data->save();

        return $this->sendResponse(new KendaraanResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = Kendaraan::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
