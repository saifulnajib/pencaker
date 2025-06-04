<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PermohonanAK1;
use App\Models\Perusahaan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
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
            // 'file_foto' => 'required',
            // 'file_ktp' => 'required',
            // 'file_ijazah' => 'required',
            // 'file_transkrip' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        if($request->hasFile('file_foto')) {
            $file = $request->file('file_foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/ak1', $filename); // storage/app/public

            $input['file_foto'] = 'uploads/ak1/'.$filename;
        }
        // else{
        //     return response()->json(['message' => 'File Pas Foto harus diunggah'], 400);
        // }
        
        if($request->hasFile('file_ktp')) {
            $file = $request->file('file_ktp');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/ak1', $filename); // storage/app/public

            $input['file_ktp'] = 'uploads/ak1/'.$filename;
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
            // 'file_foto' => 'required',
            // 'file_ktp' => 'required',
            // 'file_ijazah' => 'required',
            // 'file_transkrip' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = PermohonanAK1::find($id);

         if($request->hasFile('file_foto')) {
            $file = $request->file('file_foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/ak1', $filename); // storage/app/public

            $data->file_foto = 'uploads/ak1/'.$filename;
        }
        // else{
        //     return response()->json(['message' => 'File Pas Foto harus diunggah'], 400);
        // }
        
        if($request->hasFile('file_ktp')) {
            $file = $request->file('file_ktp');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/ak1', $filename); // storage/app/public

            $data->file_ktp = 'uploads/ak1/'.$filename;
        }

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


        $data->id_agama = $input['id_agama'];
        $data->id_kelurahan = $input['id_kelurahan'];
        $data->id_besaran_upah = $input['id_besaran_upah'];
        $data->id_disabilitas = $input['id_disabilitas'];
        $data->id_kelompok_jabatan = $input['id_kelompok_jabatan'];
        $data->id_sektor_usaha = $input['id_sektor_usaha'];
        $data->id_status_perkawinan = $input['id_status_perkawinan'];
        $data->id_tingkat_pendidikan = $input['id_tingkat_pendidikan'];
        $data->nama = $input['nama'];
        $data->email = $input['email'];
        $data->nik = $input['nik'];
        $data->tempat_lahir = $input['tempat_lahir'];
        $data->tanggal_lahir = $input['tanggal_lahir'];
        $data->tinggi_badan = $input['tinggi_badan'];
        $data->berat_badan = $input['berat_badan'];
        $data->jumlah_anak = $input['jumlah_anak'];
        $data->kendaraan = $input['kendaraan'];
        $data->gender = $input['gender'];
        $data->alamat = $input['alamat'];
        $data->rt = $input['rt'];
        $data->rw = $input['rw'];
        $data->kode_pos = $input['kode_pos'];
        $data->no_hp = $input['no_hp'];
        $data->institusi_pendidikan = $input['institusi_pendidikan'];
        $data->jurusan = $input['jurusan'];
        $data->tahun_lulus = $input['tahun_lulus'];
        $data->nilai = $input['nilai'];
        $data->jabatan_minat = $input['jabatan_minat'];
        $data->lokasi_kerja = $input['lokasi_kerja'];
        $data->kota_negara_minat = $input['kota_negara_minat'];
        $data->keterangan_singkat_pengalaman = $input['keterangan_singkat_pengalaman'];
        $data->is_pernah_bekerja = $input['is_pernah_bekerja'];
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
