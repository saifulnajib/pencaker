<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Illuminate\Http\Request;
use App\Models\PermohonanAK1;
use App\Models\Perusahaan;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\PermohonanResource;

class PermohonanController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = request()->query('size', 10);
        $data = PermohonanAK1::filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, PermohonanResource::class), 'Data retrieved successfully.');
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
            'id_agama' => 'required',
            'id_kelurahan' => 'required',
            'id_besaran_upah' => 'required',
            'id_disabilitas' => 'required',
            'id_kelompok_jabatan' => 'required',
            'id_sektor_usaha' => 'required',
            'id_status_perkawinan' => 'required',
            'id_tingkat_pendidikan' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'nik' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
            'jumlah_anak' => 'required',
            'kendaraan' => 'required',
            'gender' => 'required',
            'tempat_tinggal' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kode_pos' => 'required',
            'no_hp' => 'required',
            'institusi_pendidikan' => 'required',
            'jurusan' => 'required',
            'tahun_lulus' => 'required',
            'nilai' => 'required',
            'jabatan_minat' => 'required',
            'lokasi_kerja' => 'required',
            'kota_negara_minat' => 'required',
            'keterangan_singkat_pengalaman' => 'required',
            'is_pernah_bekerja' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = PermohonanAK1::create($input);

        return $this->sendResponse(new PermohonanResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = PermohonanAK1::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new PermohonanResource($data), 'Data retrieved successfully.');
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

        $data = PermohonanAK1::find($id);

        $data->id_perusahaan = $input['id_perusahaan'];
        $data->posisi = $input['posisi'];
        $data->deskripsi = $input['deskripsi'];
        $data->kualifikasi = $input['kualifikasi'];
        $data->lokasi = $input['lokasi'];
        $data->gaji = $input['gaji'];
        $data->expired = $input['expired'];
        $data->is_active = $input['is_active'];
        $data->save();

        return $this->sendResponse(new PermohonanResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = PermohonanAK1::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
