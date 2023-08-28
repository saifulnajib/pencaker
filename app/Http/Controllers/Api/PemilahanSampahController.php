<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use App\Models\PemilahanSampah;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PemilahanSampahResource;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;
use Pdf;

class PemilahanSampahController extends ApiController
{
    
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = PemilahanSampah::with(['kendaraan'])->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, PemilahanSampahResource::class), 'Data retrieved successfully.');
    }
    
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id_kendaraan' => 'required',
            'waktu_masuk' => 'required',
            'berat_masuk' => 'required|numeric',
            'berat_keluar' => 'numeric',
            //'keterangan'=>'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        try {
           // $input['berat_sampah'] = $input['berat_masuk'] - $input['berat_keluar'];
            $data = PemilahanSampah::create($input);

            return $this->sendResponse(new PemilahanSampahResource($data), 'Data created successfully.');
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }
    
    public function show($id): JsonResponse
    {
        $data = PemilahanSampah::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new PemilahanSampahResource($data), 'Data retrieved successfully.');
    }
    
    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id_kendaraan' => 'required',
            'waktu_masuk' => 'required',
            'waktu_keluar' => 'required',
            'berat_masuk' => 'required|numeric',
            'berat_keluar' => 'required|numeric',
            //'keterangan'=>'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = PemilahanSampah::find($id);

        $data->id_kendaraan = $input['id_kendaraan'];
        $data->waktu_masuk = $input['waktu_masuk'];
        $data->waktu_keluar = $input['waktu_keluar'];
        $data->berat_masuk = $input['berat_masuk'];
        $data->berat_keluar = $input['berat_keluar'];
        $data->berat_sampah = $input['berat_masuk'] - $input['berat_keluar'];
        $data->keterangan = $input['keterangan'];
        $data->save();

        return $this->sendResponse(new PemilahanSampahResource($data), 'Data updated successfully.');
    }
    
    public function destroy($id): JsonResponse
    {
        $data = PemilahanSampah::find($id);

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
        $data['data'] = PemilahanSampah::with(['kendaraan'])->whereMonth('waktu_masuk', $bulan)->orderBy('waktu_masuk', 'ASC')->get();
        $data['kendaraan'] = Kendaraan::where('is_active',1)->get();
        // dd($data['kendaraan']);
        $pdf = Pdf::loadView('print.pemilahan_sampah', $data);
        return $pdf->setPaper('legal', 'portrait')->stream(); // preview pdf
        //return $pdf->setPaper('legal', 'portrait')->download('sampah.pdf'); // direct download
    }
}
