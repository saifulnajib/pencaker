<?php

namespace App\Http\Controllers\Api;

use Validator;
use Carbon\Carbon;
use App\Models\Zonasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\ZonasiResource;
use App\Exports\ZonasiBulananExport;

class ZonasiController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $data = Zonasi::all();
        return $this->sendResponse(ZonasiResource::collection($data), 'Data retrieved successfully.');
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
            'nama_zona' => 'required',
            'luas' => 'required',
            'keterisian' => 'required|numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Zonasi::create($input);

        return $this->sendResponse(new ZonasiResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = Zonasi::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new ZonasiResource($data), 'Data retrieved successfully.');
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
            'nama_zona' => 'required',
            'luas' => 'required',
            'keterisian' => 'required|numeric',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Zonasi::find($id);

        $data->nama_zona = $input['nama_zona'];
        $data->luas = $input['luas'];
        $data->keterangan = $input['keterangan'] ?? '';
        $data->keterisian = $input['keterisian'];
        $data->save();

        return $this->sendResponse(new ZonasiResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = Zonasi::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }

    public function exportZonasiBulanan(Request $request)
    {
        $tahun = date('Y');
        $bulan = date('m');
        $tanggal = date('Y-m-d');

        if (!empty($request->query('tahun'))) {
            $tahun = $request->query('tahun');
        }
        
        if (!empty($request->query('bulan'))) {
            $bulan = $request->query('bulan');
        }

        $exportTime = Carbon::parse("$tanggal")->locale('id-ID');
        $dataTime = Carbon::parse("$tahun-$bulan-01")->locale('id-ID');
        $is_semua = false;           
        // $data = Zonasi::whereMonth('created_at',$bulan)->whereYear('created_at',$tahun)->get();
        if (empty($request->query('bulan'))){
            $data = Zonasi::all();
            $is_semua = true;
        }else{
            $data = Zonasi::whereMonth('created_at',$bulan)->whereYear('created_at',$tahun)->get();
        }

        $data = [
            'data' => $data,
            'time' => $exportTime->translatedFormat('l / d F Y'),
            'bulan' => Str::upper($dataTime->translatedFormat('F')),
            'tahun' => $dataTime->translatedFormat('Y'),
            'is_semua' => $is_semua,
            'ttd' => [
                'lokasi' => "Tanjungpinang",
                'waktu' => $exportTime->translatedFormat('d F Y'),
                'jabatan' => "Kepala UPTD TPA",
                'nama_pejabat' => "M. RIPAYANDI PUTRA, S.E",
                'nip_pejabat' => "19731125 2000604 1 006",
            ],
        ];
        
        $export_name = "Data-zonasi-bulan-".$data['bulan']."-".$data['tahun'].".xlsx";

        return Excel::download(new ZonasiBulananExport($data), $export_name);
    }
}
