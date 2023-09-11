<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Carbon\Carbon;
use App\Models\PemilahanSampah;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\PemilahanSampahResource;
use App\Exports\PemilahanSampahBulananExport;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;

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

    public function exportPemilahanSampahBulanan(Request $request)
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

        $n = $dataTime->daysInMonth;
        $dt = [];
        for($i=1;$i<=$n;$i++){
            $tanggalnya = Carbon::parse("$tahun-$bulan-$i")->locale('id-ID');
            $data = PemilahanSampah::with(['kendaraan'])->whereDate('waktu_masuk',$tanggalnya)->orderBy('waktu_masuk','asc')->get();
            $row = [
                "tanggal" => $tanggalnya->translatedFormat('d/m/Y'),
                "data"=>$data
            ];
            $dt[] = $row;
        }

        $data = [
            'data' => $dt,
            'jumlah_masuk' => 0,
            'jumlah_keluar' => 0,
            'jumlah_isi' => 0,
            'jumlah_kompos' => 0,
            'time' => $exportTime->translatedFormat('l / d F Y'),
            'bulan' => Str::upper($dataTime->translatedFormat('F')),
            'tahun' => $tahun,
            'ttd' => [
                'lokasi' => "Tanjungpinang",
                'waktu' => $exportTime->translatedFormat('d F Y'),
                'jabatan' => "Kepala UPTD TPA",
                'nama_pejabat' => "M. RIPAYANDI PUTRA, S.E",
                'nip_pejabat' => "19731125 2000604 1 006",
                'nama_pengawas' => "ENDANG",
                'nip_pengawas' => "19790715 200604 1 024",
            ],
        ];

        $export_name = "Laporan-bulanan-pemilahan-sampah-".$data['bulan'].".xlsx";

        return Excel::download(new PemilahanSampahBulananExport($data), $export_name);
    }
}
