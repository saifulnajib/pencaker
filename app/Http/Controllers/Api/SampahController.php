<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use App\Models\Sampah;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\SampahResource;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use Pdf;

class SampahController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = Sampah::with(['jenisSampah','kendaraan'])->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, SampahResource::class), 'Data retrieved successfully.');
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
            'id_kendaraan' => 'required',
            'id_jenis_sampah' => 'required',
            'nomor_karcis' => 'required',
            'waktu_masuk' => 'required',
            // 'waktu_keluar' => 'required',
            'jenis_retribusi' => 'required',
            'berat_masuk' => 'required',
            // 'berat_keluar' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        try {
            $input['berat_sampah'] = (!empty($input['berat_keluar'])) ? ($input['berat_masuk'] - $input['berat_keluar']) : 0;
            $input['volume'] = ($input['berat_sampah'] / 1000) * 4;
            $input['tarif_retribusi'] = ($input['jenis_retribusi'] == "umum") ? 5000 : 0;

            $data = Sampah::create($input);

            return $this->sendResponse(new SampahResource($data), 'Data created successfully.');
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = Sampah::with(['jenisSampah','kendaraan', 'kendaraan.jenisKendaraan', 'kendaraan.ruteKendaraan'])->find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new SampahResource($data), 'Data retrieved successfully.');
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
            'id_kendaraan' => 'required',
            'id_jenis_sampah' => 'required',
            'nomor_karcis' => 'required',
            'waktu_masuk' => 'required',
            'waktu_keluar' => 'required',
            'jenis_retribusi' => 'required',
            'berat_masuk' => 'required',
            'berat_keluar' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Sampah::find($id);

        $data->id_kendaraan = $input['id_kendaraan'];
        $data->id_jenis_sampah = $input['id_jenis_sampah'];
        $data->nomor_bak = $input['nomor_bak'];
        $data->nomor_karcis = $input['nomor_karcis'];
        $data->waktu_masuk = $input['waktu_masuk'];
        $data->waktu_keluar = $input['waktu_keluar'];
        $data->jenis_retribusi = $input['jenis_retribusi'];
        $data->tarif_retribusi = ($input['jenis_retribusi'] == "umum") ? 5000 : 0;
        $data->berat_masuk = $input['berat_masuk'];
        $data->berat_keluar = $input['berat_keluar'];
        $data->berat_sampah = $input['berat_masuk'] - $input['berat_keluar'];
        $data->volume = ($data->berat_sampah / 1000) * 4;
        $data->sumber_sampah = $input['sumber_sampah'];
        $data->keterangan = $input['keterangan'];
        $data->save();

        return $this->sendResponse(new SampahResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = Sampah::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }

    public function print($jenis,$tahun,$bulan,$tanggal)
    {
        $data['tanggal'] = $tahun.'-'.$bulan.'-'.$tanggal;
        $data['sampah'] = Sampah::with(['jenisSampah','kendaraan'])->whereDate('waktu_masuk',$data['tanggal'])->get();
        $pdf = Pdf::loadView('print.sampah', $data);
        // dd($data);
        return $pdf->setPaper('legal', 'landscape')->stream(); // preview pdf
        //return $pdf->setPaper('legal', 'portrait')->download('sampah.pdf'); // direct download
    }
}
