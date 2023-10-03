<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\UsulanProklim;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\UsulanProklimResource;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;
use App\Exports\UsulanProklimExport;

class UsulanProklimController extends ApiController
{
    
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = UsulanProklim::filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, UsulanProklimResource::class), 'Data retrieved successfully.');
    }
    
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama' => 'required',
            'alamat' => 'required',
            'kode_wilayah' => 'required',
            'nama_ketua' => 'required',
            'nomor_telpon' => 'required',
            'jumlah_anggota' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        if ($request->hasFile('file_surat_usulan')) {
            $file = $request->file('file_surat_usulan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/usulanproklim', $filename); // storage/app/public

            $input['file_surat_usulan'] = 'uploads/usulanproklim/'.$filename;
        }else{
            return response()->json(['message' => 'File surat usulan harus diunggah'], 400);
        }

        try {
            $data = UsulanProklim::create($input);

            return $this->sendResponse(new UsulanProklimResource($data), 'Data created successfully.');
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }
    
    public function show($id): JsonResponse
    {
        $data = UsulanProklim::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new UsulanProklimResource($data), 'Data retrieved successfully.');
    }
    
    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama' => 'required',
            'alamat' => 'required',
            'kode_wilayah' => 'required',
            'nama_ketua' => 'required',
            'nomor_telpon' => 'required',
            'status_usulan' => 'required',
            'jumlah_anggota' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = UsulanProklim::find($id);

        if ($request->hasFile('file_surat_usulan')) {
            $file = $request->file('file_surat_usulan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/usulanproklim', $filename); // storage/app/public

            $data->file_surat_usulan = 'uploads/usulanproklim/'.$filename;
        }

        $data->nama = $input['nama'];
        $data->alamat = $input['alamat'];
        $data->kode_wilayah = $input['kode_wilayah'];
        $data->nama_ketua = $input['nama_ketua'];
        $data->nomor_telpon = $input['nomor_telpon'];
        $data->status_usulan = $input['status_usulan'];
        $data->jumlah_anggota = $input['jumlah_anggota'];
        $data->save();

        return $this->sendResponse(new UsulanProklimResource($data), 'Data updated successfully.');
    }
    
    public function destroy($id): JsonResponse
    {
        $data = UsulanProklim::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }

    public function exportUsulanProklim(Request $request)
    {
        $tanggal = date('Y-m-d');

        if (!empty($request->query('tanggal'))) {
            $tanggal = $request->query('tanggal');
        }

        $exportTime = Carbon::parse("$tanggal")->locale('id-ID');

        $data = UsulanProklim::all();

        $data = [
            'data' => $data,
            'time' => $exportTime->translatedFormat('l / d F Y'),
            'bulan' => Str::upper($exportTime->translatedFormat('F')),
        ];
        
        $export_name = "Data-Usulan-Proklim-$tanggal.xlsx";

        return Excel::download(new UsulanProklimExport($data), $export_name);
    }
}
