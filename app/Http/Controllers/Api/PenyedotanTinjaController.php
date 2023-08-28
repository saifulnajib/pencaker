<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use App\Models\PenyedotanTinja;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PenyedotanTinjaResource;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;
use Pdf;

class PenyedotanTinjaController extends ApiController
{
    
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = PenyedotanTinja::with(['kategoriPenyedotan'])->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, PenyedotanTinjaResource::class), 'Data retrieved successfully.');
    }
    
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id_kategori' => 'required',
            'nama' => 'required',
            'nomor_karcis' => 'required|numeric',
            'nomor_telpon' => 'required|numeric',
            'alamat' => 'required',
            'tanggal_penyedotan' => 'required',
            'retribusi_penyedotan' => 'required|numeric',
            'retribusi_pembuangan' => 'required|numeric',
            //'keterangan'=>'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        try {
            $data = PenyedotanTinja::create($input);

            return $this->sendResponse(new PenyedotanTinjaResource($data), 'Data created successfully.');
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }
    
    public function show($id): JsonResponse
    {
        $data = PenyedotanTinja::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new PenyedotanTinjaResource($data), 'Data retrieved successfully.');
    }
    
    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id_kategori' => 'required',
            'nama' => 'required',
            'nomor_karcis' => 'required|numeric',
            'nomor_telpon' => 'required|numeric',
            'alamat' => 'required',
            'tanggal_penyedotan' => 'required',
            'retribusi_penyedotan' => 'required|numeric',
            'retribusi_pembuangan' => 'required|numeric',
            //'keterangan'=>'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = PenyedotanTinja::find($id);

        $data->id_kategori = $input['id_kategori'];
        $data->nama = $input['nama'];
        $data->nomor_karcis = $input['nomor_karcis'];
        $data->nomor_telpon = $input['nomor_telpon'];
        $data->alamat = $input['alamat'];
        $data->tanggal_penyedotan = $input['tanggal_penyedotan'];
        $data->retribusi_penyedotan = $input['retribusi_penyedotan'];
        $data->retribusi_pembuangan = $input['retribusi_pembuangan'];
        $data->keterangan = $input['keterangan'];
        $data->save();

        return $this->sendResponse(new PenyedotanTinjaResource($data), 'Data updated successfully.');
    }
    
    public function destroy($id): JsonResponse
    {
        $data = PenyedotanTinja::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }

    public function print($tahun,$bulan)
    {
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['data'] = PenyedotanTinja::with(['kategoriPenyedotan'])->whereMonth('tanggal_penyedotan', $bulan)->get();
        $data['jumlah_penyedotan'] = array_sum(array_column($data['data']->toArray(),'retribusi_penyedotan'));
        $data['jumlah_pembuangan'] = array_sum(array_column($data['data']->toArray(),'retribusi_pembuangan'));
        $pdf = Pdf::loadView('print.penyedotan_tinja', $data);
        return $pdf->setPaper('legal', 'landscape')->stream(); // preview pdf
        //return $pdf->setPaper('legal', 'portrait')->download('sampah.pdf'); // direct download
    }
}
