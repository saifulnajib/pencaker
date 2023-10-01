<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Carbon\Carbon;
use App\Models\Proklim;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\ProklimResource;
use App\Http\Resources\TitikKoordinatResource;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;
use App\Exports\ProklimExport;

class ProklimController extends ApiController
{
    
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = Proklim::with(['kategoriProklim'])->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, ProklimResource::class), 'Data retrieved successfully.');
    }
    
    public function pemetaan(Request $request): JsonResponse
    {
        $data = Proklim::all();
        return $this->sendResponse(TitikKoordinatResource::collection($data), 'Data retrieved successfully.');
    }
    
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama' => 'required',
            'id_kategori' => 'required',
            'alamat' => 'required',
            'no_registrasi' => 'required',
            'tahun_proklim' => 'required',
            'kode_wilayah' => 'required',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
            'ketua' => 'required',
            'jumlah_anggota' => 'numeric|required',
            'fokus_daerah' => 'required',
            'nomor_daerah' => 'required',
            'is_active' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/proklim', $filename); // storage/app/public

            $input['file_sertifikat'] = 'uploads/proklim/'.$filename;
        }else{
            return response()->json(['message' => 'File sertifikat harus diunggah'], 400);
        }

        try {
            $data = Proklim::create($input);

            return $this->sendResponse(new ProklimResource($data), 'Data created successfully.');
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }
    
    public function show($id): JsonResponse
    {
        $data = Proklim::with(['kategoriProklim'])->find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new ProklimResource($data), 'Data retrieved successfully.');
    }
    
    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nama' => 'required',
            'id_kategori' => 'required',
            'alamat' => 'required',
            'no_registrasi' => 'required',
            'tahun_proklim' => 'required',
            'kode_wilayah' => 'required',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
            'ketua' => 'required',
            'jumlah_anggota' => 'numeric|required',
            'fokus_daerah' => 'required',
            'nomor_daerah' => 'required',
            'is_active' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Proklim::find($id);

        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/proklim', $filename); // storage/app/public

            $data->file_sertifikat = 'uploads/proklim/'.$filename;
        }

        $data->nama = $input['nama'];
        $data->id_kategori = $input['id_kategori'];
        $data->alamat = $input['alamat'];
        $data->no_registrasi = $input['no_registrasi'];
        $data->tahun_proklim = $input['tahun_proklim'];
        $data->kode_wilayah = $input['kode_wilayah'];
        $data->latitude = $input['latitude'];
        $data->longitude = $input['longitude'];
        $data->ketua = $input['ketua'];
        $data->jumlah_anggota = $input['jumlah_anggota'];
        $data->fokus_daerah = $input['fokus_daerah'];
        $data->nomor_sk = $input['nomor_sk'];
        $data->is_active = $input['is_active'];
        $data->save();

        return $this->sendResponse(new ProklimResource($data), 'Data updated successfully.');
    }
    
    public function destroy($id): JsonResponse
    {
        $data = Proklim::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }

    public function exportProklim(Request $request)
    {
        $tahun = date('Y');
        $tanggal = date('Y-m-d');

        if (!empty($request->query('tahun'))) {
            $tahun = $request->query('tahun');
        }

        $exportTime = Carbon::parse("$tanggal")->locale('id-ID');
        if (empty($request->query('tahun'))){
            $data = Proklim::all();
        }else{
            $data = Proklim::where('tahun_proklim','<=',$tahun)->get();
        }

        $data = [
            'data' => $data,
            'time' => $exportTime->translatedFormat('l / d F Y'),
            'tahun' => $tahun,
            'ttd' => [
                'lokasi' => "Tanjungpinang",
                'waktu' => $exportTime->translatedFormat('d F Y'),
                'jabatan' => "Kepala Bidang Tata Lingkungan",
                'nama_pejabat' => "Hj. Endang Suhartati, S.Sos",
                'nip_pejabat' => "19780218 200604 2 024",
            ],
        ];
        
        $export_name = "Data-Proklim"."-".$data['tahun'].".xlsx";

        return Excel::download(new ProklimExport($data), $export_name);
    }
}
