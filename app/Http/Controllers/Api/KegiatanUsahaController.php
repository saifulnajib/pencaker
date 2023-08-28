<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Illuminate\Http\Request;
use App\Models\KegiatanUsaha;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\KegiatanUsahaResource;

class KegiatanUsahaController extends ApiController
{

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = KegiatanUsaha::with(['sektorKegiatan'])->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, KegiatanUsahaResource::class), 'Data retrieved successfully.');
    }

    public function option(Request $request): JsonResponse
    {
        $data = KegiatanUsaha::select('id', DB::raw("CONCAT(nama_usaha,' / ',nama_penanggungjawab) as name"))->latest('updated_at')->get();
        return $this->sendResponse($data, 'Data retrieved successfully.');
    }


    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama_usaha' => 'required',
            'alamat' => 'required',
            'id_sektor' => 'required',
            'nama_penanggungjawab' => 'required',
            'dokumen_lh' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        if ($request->hasFile('file_dokumen_lh')) {
            $file = $request->file('file_dokumen_lh');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/kegiatan_usaha', $filename); // storage/app/public

            $input['file_dokumen_lh'] = 'uploads/kegiatan_usaha/'.$filename;
        }else{
            return response()->json(['message' => 'File Dokumen LH harus diunggah'], 400);
        }

        try {
            $data = KegiatanUsaha::create($input);

            return $this->sendResponse(new KegiatanUsahaResource($data), 'Data created successfully.');
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }

    public function show($id): JsonResponse
    {
        $data = KegiatanUsaha::with(['sektorKegiatan'])->find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new KegiatanUsahaResource($data), 'Data retrieved successfully.');
    }

    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama_usaha' => 'required',
            'alamat' => 'required',
            'id_sektor' => 'required',
            'nama_penanggungjawab' => 'required',
            'dokumen_lh' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = KegiatanUsaha::find($id);

        if ($request->hasFile('file_dokumen_lh')) {
            $file = $request->file('file_dokumen_lh');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/kegiatan_usaha', $filename); // storage/app/public

            $data->file_dokumen_lh = 'uploads/kegiatan_usaha/'.$filename;
        }

        $data->nama_usaha = $input['nama_usaha'];
        $data->nama_penanggungjawab = $input['nama_penanggungjawab'];
        $data->alamat = $input['alamat'];
        $data->id_sektor = $input['id_sektor'];
        $data->keterangan = $input['keterangan'] ?? '';
        $data->save();

        return $this->sendResponse(new KegiatanUsahaResource($data), 'Data updated successfully.');
    }

    public function destroy($id): JsonResponse
    {
        $data = KegiatanUsaha::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
