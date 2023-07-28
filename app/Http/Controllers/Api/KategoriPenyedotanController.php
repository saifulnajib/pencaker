<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\KategoriPenyedotan;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\KategoriPenyedotanResource;
use App\Http\Resources\KategoriPenyedotanCollection;

class KategoriPenyedotanController extends ApiController
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
        $data = KategoriPenyedotan::query();
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
        return $this->sendResponse(new KategoriPenyedotanCollection($data), 'Data retrieved successfully.');
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
            'kategori' => 'required',
            'is_active' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = KategoriPenyedotan::create($input);

        return $this->sendResponse(new KategoriPenyedotanResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = KategoriPenyedotan::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new KategoriPenyedotanResource($data), 'Data retrieved successfully.');
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
            'kategori' => 'required',
            'is_active' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = KategoriPenyedotan::find($id);

        $data->kategori = $input['kategori'];
        $data->is_active = $input['is_active'];
        $data->save();

        return $this->sendResponse(new KategoriPenyedotanResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = KategoriPenyedotan::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
