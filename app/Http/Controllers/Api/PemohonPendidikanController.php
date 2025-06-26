<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PermohonanAK1;
use App\Models\Perusahaan;
use App\Models\PemohonPendidikan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\PemohonPendidikanResource;

class PemohonPendidikanController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = request()->query('size', 10);
        $data = PemohonPendidikan::filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, PemohonPendidikanResource::class), 'Data retrieved successfully.');
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
            'nik' =>'required|unique:pemohon_pendidikan,nik',
            'id_tingkat_pendidikan' => 'required',
            'institusi_pendidikan' => 'required',
            'jurusan' => 'required',
            'tahun_lulus' => 'required',
            'nilai' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        if($request->hasFile('file_ijazah')) {
            $file = $request->file('file_ijazah');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/ak1', $filename); // storage/app/public

            $input['file_ijazah'] = 'uploads/ak1/'.$filename;
        }
        
        if($request->hasFile('file_transkrip')) {
            $file = $request->file('file_transkrip');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/ak1', $filename); // storage/app/public

            $input['file_transkrip'] = 'uploads/ak1/'.$filename;
        }

        $data = PemohonPendidikan::create($input);

        return $this->sendResponse(new PemohonPendidikanResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = PemohonPendidikan::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new PemohonPendidikanResource($data), 'Data retrieved successfully.');
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
            'nik' =>'required|unique:pemohon_pendidikan,nik,'.$id.',nik',
            'id_tingkat_pendidikan' => 'required',
            'institusi_pendidikan' => 'required',
            'jurusan' => 'required',
            'tahun_lulus' => 'required|numeric',
            'nilai' => 'required|numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = PemohonPendidikan::find($id);

         if($request->hasFile('file_ijazah')) {
            $file = $request->file('file_ijazah');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/ak1', $filename); // storage/app/public

            $data->file_ijazah = 'uploads/ak1/'.$filename;
        }
        
        if($request->hasFile('file_transkrip')) {
            $file = $request->file('file_transkrip');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/ak1', $filename); // storage/app/public

            $data->file_transkrip = 'uploads/ak1/'.$filename;
        }

        $data->nik = $input['nik'];
        $data->id_tingkat_pendidikan = $input['id_tingkat_pendidikan'];
        $data->institusi_pendidikan = $input['institusi_pendidikan'];
        $data->jurusan = $input['jurusan'];
        $data->tahun_lulus = $input['tahun_lulus'];
        $data->nilai = $input['nilai'];
        $data->save();

        return $this->sendResponse(new PemohonPendidikanResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = PemohonPendidikan::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }

    public function uploadFile(Request $request, $id): JsonResponse
    {
        $message = 'No file was uploaded. Please attach a file and try again.';
        $data = PemohonPendidikan::find($id);

         if($request->hasFile('file_ijazah')) {
            $file = $request->file('file_ijazah');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/ak1', $filename); // storage/app/public

            $data->file_ijazah = 'uploads/ak1/'.$filename;
        }
        
        if($request->hasFile('file_transkrip')) {
            $file = $request->file('file_transkrip');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/ak1', $filename); // storage/app/public

            $data->file_transkrip = 'uploads/ak1/'.$filename;
        }

        if($request->hasFile('file_ijazah') || $request->hasFile('file_transkrip')){
            $message = 'File uploaded successfully.';
            $data->save();
        }

        return $this->sendResponse(new PemohonPendidikanResource($data), $message);
    }
}
