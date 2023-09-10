<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Carbon\Carbon;
use App\Models\PenyedotanTinja;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\PenyedotanTinjaResource;
use App\Exports\SedotTinjaBulananExport;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;

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

    public function exportSedotTinjaBulanan(Request $request)
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

        $data_tinja = PenyedotanTinja::with(['kategoriPenyedotan'])->whereMonth('tanggal_penyedotan',$bulan)->whereYear('tanggal_penyedotan',$tahun)->get();

        $data = [
            'data' => $data_tinja,
            'jumlah_penyedotan' => array_sum(array_column($data_tinja->toArray(),'retribusi_penyedotan')),
            'jumlah_pembuangan' => array_sum(array_column($data_tinja->toArray(),'retribusi_pembuangan')),
            'time' => $exportTime->translatedFormat('l / d F Y'),
            'bulan' => Str::upper($dataTime->translatedFormat('F')),
            'tahun' => $tahun,
            'ttd' => [
                'lokasi' => "Tanjungpinang",
                'waktu' => $exportTime->translatedFormat('d F Y'),
                'jabatan' => "Kepala UPTD TPA",
                'nama_pejabat' => "M. RIPAYANDI PUTRA, S.E",
                'nip_pejabat' => "19731125 2000604 1 006"
            ],
        ];

        $export_name = "Laporan-bulanan-penyedotan-tinja-$tanggal.xlsx";

        return Excel::download(new SedotTinjaBulananExport($data), $export_name);
    }
}
