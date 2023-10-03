<?php

namespace App\Http\Controllers\Api;

use Validator;
use Carbon\Carbon;
use App\Models\Pegawai;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\PegawaiResource;
use App\Exports\PegawaiPnsExport;
use App\Exports\PegawaiHonorerExport;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;

class PegawaiController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = Pegawai::filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, PegawaiResource::class), 'Data retrieved successfully.');
    }

    /**
     * Display a listing of the resource for dropdown.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function option(Request $request): JsonResponse
    {
        $data = Pegawai::select('id', DB::raw("CONCAT(nama,' - ',nip) as name"))->latest('updated_at')->get();
        return $this->sendResponse($data, 'Data retrieved successfully.');
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
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'nip' => 'numeric',
            'nik' => 'numeric',
            'no_bpjs' => 'numeric',
            'no_bpjs_tk' => 'numeric',
            'no_pbb' => 'numeric',
            'jenis_pegawai' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Pegawai::create($input);

        return $this->sendResponse(new PegawaiResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = Pegawai::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new PegawaiResource($data), 'Data retrieved successfully.');
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
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'nip' => 'numeric',
            'nik' => 'numeric',
            'no_bpjs' => 'numeric',
            'no_bpjs_tk' => 'numeric',
            'no_pbb' => 'numeric',
            'jenis_pegawai' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Pegawai::find($id);

        $data->nama = $input['nama'];
        $data->nip = $input['nip'];
        $data->nik = $input['nik'];
        $data->no_sk = $input['no_sk'];
        $data->tanggal_sk = $input['tanggal_sk'];
        $data->tanggal_awal_kerja = $input['tanggal_awal_kerja'];
        $data->jenis_pegawai = $input['jenis_pegawai'];
        $data->jenis_kelamin = $input['jenis_kelamin'];
        $data->golongan = $input['golongan'];
        $data->ruang = $input['ruang'];
        $data->tmt = $input['tmt'];
        $data->masa_kerja = $input['masa_kerja'];
        $data->nama_jabatan = $input['nama_jabatan'];
        $data->bidang = $input['bidang'];
        $data->tmt_jabatan = $input['tmt_jabatan'];
        $data->nama_latihaan = $input['nama_latihaan'];
        $data->bulan_tahun_latihan = $input['bulan_tahun_latihan'];
        $data->lama_latihan = $input['lama_latihan'];
        $data->nama_pendidikan = $input['nama_pendidikan'];
        $data->lulusan_pendidikan = $input['lulusan_pendidikan'];
        $data->tingkat_ijazah_pendidikan = $input['tingkat_ijazah_pendidikan'];
        $data->tempat_lahir = $input['tempat_lahir'];
        $data->tanggal_lahir = $input['tanggal_lahir'];
        $data->alamat = $input['alamat'];
        $data->nomor_telpon = $input['nomor_telpon'];
        $data->no_bpjs = $input['no_bpjs'];
        $data->no_bpjs_tk = $input['no_bpjs_tk'];
        $data->jenjang_pendidikan = $input['jenjang_pendidikan'];
        $data->jurusan_pendidikan = $input['jurusan_pendidikan'];
        $data->no_pbb = $input['no_pbb'];
        $data->status_nikah = $input['status_nikah'];
        $data->gol_darah = $input['gol_darah'];
        $data->agama = $input['agama'];
        $data->sertifikat_kompetensi = $input['sertifikat_kompetensi'];
        $data->tugas_jabatan = $input['tugas_jabatan'];
        $data->lokasi_kerja_pengawas = $input['lokasi_kerja_pengawas'];
        $data->lokasi_kerja_pekerja = $input['lokasi_kerja_pekerja'];
        $data->nama_korlap = $input['nama_korlap'];
        $data->nama_pengawas = $input['nama_pengawas'];
        $data->unit_kerja = $input['unit_kerja'];
        $data->status_keaktifan = $input['status_keaktifan'];
        $data->tanggal_status_keaktifan = $input['tanggal_status_keaktifan'];
        $data->foto = $input['foto'];
        
        $data->save();

        return $this->sendResponse(new PegawaiResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = Pegawai::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
    
    public function exportPegawaiPns(Request $request)
    {
        $tanggal = date('Y-m-d');

        if (!empty($request->query('tanggal'))) {
            $tanggal = $request->query('tanggal');
        }

        $exportTime = Carbon::parse("$tanggal")->locale('id-ID');

        $data = Pegawai::where('jenis_pegawai','PNS')->get();

        $data = [
            'data' => $data,
            'time' => $exportTime->translatedFormat('l / d F Y'),
            'bulan' => Str::upper($exportTime->translatedFormat('F')),
            'ttd' => [
                'lokasi' => "Tanjungpinang",
                'waktu' => $exportTime->translatedFormat('d F Y'),
                'jabatan' => "Kepala Dinas Lingkungan Hidup",
                'nama_pejabat' => "Drs. Riono, M.Si",
                'nip_pejabat' => "19731125 2000604 1 006",
            ],
        ];
        
        $export_name = "Rekap-data-PNS-$tanggal.xlsx";

        return Excel::download(new PegawaiPnsExport($data), $export_name);
    }
    
    public function exportPegawaiHonorer(Request $request)
    {
        $tanggal = date('Y-m-d');

        if (!empty($request->query('tanggal'))) {
            $tanggal = $request->query('tanggal');
        }

        $exportTime = Carbon::parse("$tanggal")->locale('id-ID');

        $data = Pegawai::where('jenis_pegawai','!=','PNS')->get();

        $data = [
            'data' => $data,
            'time' => $exportTime->translatedFormat('l / d F Y'),
            'bulan' => Str::upper($exportTime->translatedFormat('F')),
            'ttd' => [
                'lokasi' => "Tanjungpinang",
                'waktu' => $exportTime->translatedFormat('d F Y'),
                'jabatan' => "Kepala Dinas Lingkungan Hidup",
                'nama_pejabat' => "Drs. Riono, M.Si",
                'nip_pejabat' => "19731125 2000604 1 006",
            ],
        ];
        
        $export_name = "Rekap-data-honorer-$tanggal.xlsx";

        return Excel::download(new PegawaiHonorerExport($data), $export_name);
    }
}
