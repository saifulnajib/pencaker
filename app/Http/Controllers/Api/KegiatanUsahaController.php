<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KegiatanUsaha;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\KegiatanUsahaResource;
use App\Exports\PertekExport;
use App\Exports\KegiatanUsahaExport;

class KegiatanUsahaController extends ApiController
{

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $pertek  = $request->query('pertek',0);
        $data = KegiatanUsaha::with(['sektorKegiatan'])->when($pertek, function ($query) {
            $query->where('nomor_pertek','!=',null);
        })->filter()->paginate($perPage);
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
            'alamat_penanggungjawab' => 'required',
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
            'alamat_penanggungjawab' => 'required',
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
        $data->alamat_penanggungjawab = $input['alamat_penanggungjawab'];
        $data->id_sektor = $input['id_sektor'];
        $data->keterangan = $input['keterangan'] ?? '';
        $data->tanggal_pertek = $input['tanggal_pertek'];
        $data->nomor_pertek = $input['nomor_pertek'];
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

    public function exportPertek(Request $request)
    {
        $tanggal = date('Y-m-d');

        $data = KegiatanUsaha::with(['sektorKegiatan'])->where('nomor_pertek','!=',null)->get();


        $exportTime = Carbon::parse("$tanggal")->locale('id-ID');

        $data = [
            'data' => $data,
            'time' => $exportTime->translatedFormat('l / d F Y'),
            'ttd' => [
                'lokasi' => "Tanjungpinang",
                'waktu' => $exportTime->translatedFormat('d F Y'),
                'jabatan' => "Kepala Dinas Lingkungan Hidup",
                'nama_pejabat' => "Drs. Riono, M.Si",
                'nip_pejabat' => "19670416 199401 1 001",
            ],
        ];
        
        $export_name = "Data-Pertek.xlsx";

        return Excel::download(new PertekExport($data), $export_name);
    }

    public function exportKegiatanUsaha(Request $request)
    {
        $tanggal = date('Y-m-d');

        if (!empty($request->query('tanggal'))) {
            $tanggal = $request->query('tanggal');
        }

        $exportTime = Carbon::parse("$tanggal")->locale('id-ID');

        $data = KegiatanUsaha::with(['sektorKegiatan'])->get();

        $data = [
            'data' => $data,
            'time' => $exportTime->translatedFormat('l / d F Y'),
            'bulan' => Str::upper($exportTime->translatedFormat('F')),
        ];
        
        $export_name = "Data-kegiatan-usaha-$tanggal.xlsx";

        return Excel::download(new KegiatanUsahaExport($data), $export_name);
    }
}
