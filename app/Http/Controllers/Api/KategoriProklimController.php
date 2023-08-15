<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\KategoriProklim;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\KategoriProklimResource;

class KategoriProklimController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = KategoriProklim::filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, KategoriProklimResource::class), 'Data retrieved successfully.');
    }


    public function option(Request $request): JsonResponse
    {
        $data = KategoriProklim::select('id', 'kategori as name')->where('is_active', 1)->latest('updated_at')->get();
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
            'kategori' => 'required',
            'is_active' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = KategoriProklim::create($input);

        return $this->sendResponse(new KategoriProklimResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = KategoriProklim::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new KategoriProklimResource($data), 'Data retrieved successfully.');
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

        $data = KategoriProklim::find($id);

        $data->kategori = $input['kategori'];
        $data->is_active = $input['is_active'];
        $data->save();

        return $this->sendResponse(new KategoriProklimResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = KategoriProklim::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
