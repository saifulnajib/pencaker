<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PermohonanAK1;
use App\Models\Perusahaan;
use App\Models\PemohonPekerjaan;
use App\Models\PemohonPengalamanKerja;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\PemohonPekerjaanResource;
use App\Http\Resources\PemohonPengalamanKerjaResource;
                        

class PemohonPekerjaanController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = request()->query('size', 10);
        $data = PemohonPekerjaan::filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, PemohonPekerjaanResource::class), 'Data retrieved successfully.');
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
            'nik' =>'required|unique:pemohon_pekerjaan,nik',
            'lokasi_kerja' =>'required',
            'jabatan_minat' =>'required',
            'kota_negara_minat' =>'required',
            'tahun_mulai' =>'required',
            'id_besaran_upah' => 'required',
            'id_kelompok_jabatan' => 'required',
            'id_sektor_usaha' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = PemohonPekerjaan::create($input);

        return $this->sendResponse(new PemohonPekerjaanResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = PemohonPekerjaan::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new PemohonPekerjaanResource($data), 'Data retrieved successfully.');
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
            'nik' =>'required|unique:pemohon_pekerjaan,nik,'.$id.',nik',
            'lokasi_kerja' =>'required',
            'jabatan_minat' =>'required',
            'kota_negara_minat' =>'required',
            'is_pernah_bekerja' =>'required',
            'id_besaran_upah' => 'required',
            'id_kelompok_jabatan' => 'required',
            'id_sektor_usaha' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = PemohonPekerjaan::find($id);

        $data->nik = $input['nik'];
        $data->lokasi_kerja = $input['lokasi_kerja'];
        $data->jabatan_minat = $input['jabatan_minat'];
        $data->kota_negara_minat = $input['kota_negara_minat'];
        $data->is_pernah_bekerja = $input['is_pernah_bekerja'];
        $data->id_besaran_upah = $input['id_besaran_upah'];
        $data->id_kelompok_jabatan = $input['id_kelompok_jabatan'];
        $data->id_sektor_usaha = $input['id_sektor_usaha'];
        $data->save();

        return $this->sendResponse(new PemohonPekerjaanResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = PemohonPekerjaan::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }


    public function pengalaman(Request $request, $nik): JsonResponse
    {
        $perPage = request()->query('size', 10);
        $data = PemohonPengalamanKerja::where('nik',$nik)->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, PemohonPengalamanKerjaResource::class), 'Data retrieved successfully.');
    }

    public function createPengalaman(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nik' =>'required',
            'jabatan' =>'required',
            'uraian_tugas' =>'required',
            'tahun_mulai' =>'required|numeric',
            'tahun_selesai' => 'required|numeric',
            'lama_bekerja' => 'required|numeric',
            'nama_perusahaan' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        if($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/ak1', $filename); // storage/app/public

            $input["file"] = 'uploads/ak1/'.$filename;
        }

        $data = PemohonPengalamanKerja::create($input);

        return $this->sendResponse(new PemohonPengalamanKerjaResource($data), 'Data created successfully.');
    }


    public function updatePengalaman(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nik' =>'required',
            'jabatan' =>'required',
            'uraian_tugas' =>'required',
            'tahun_mulai' =>'required|numeric',
            'tahun_selesai' => 'required|numeric',
            'lama_bekerja' => 'required|numeric',
            'nama_perusahaan' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = PemohonPengalamanKerja::find($id);

        $data->nik = $input['nik'];
        $data->jabatan = $input['jabatan'];
        $data->uraian_tugas = $input['uraian_tugas'];
        $data->tahun_mulai = $input['tahun_mulai'];
        $data->tahun_selesai = $input['tahun_selesai'];
        $data->lama_bekerja = $input['lama_bekerja'];
        $data->nama_perusahaan = $input['nama_perusahaan'];

        if($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/ak1', $filename); // storage/app/public

            $data->file = 'uploads/ak1/'.$filename;
        }

        $data->save();

        return $this->sendResponse(new PemohonPengalamanKerjaResource($data), 'Data updated successfully.');
    }

    public function destroyPengalaman($id): JsonResponse
    {
        $data = PemohonPengalamanKerja::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
