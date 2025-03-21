<?php
namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\BesaranUpah;
use App\Models\Disabilitas;
use App\Models\KelompokJabatan;
use App\Models\Kelurahan;
use App\Models\PermohonanAk1;
use App\Models\SektorUsaha;
use App\Models\StatusPerkawinan;
use App\Models\TingkatPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AK1Controller extends Controller
{
    public function index(Request $request)
    {
        $ak1 = PermohonanAk1::all();

        // Kirim data kosong agar blade tidak error
        return view('admin.ak1.index', compact('ak1'));
    }

    public function create()
    {
        $agama = Agama::all();
        $status_perkawinan = StatusPerkawinan::all();
        $tingkat_pendidikan = TingkatPendidikan::all();
        $sektor_usaha = SektorUsaha::all();
        $kelompok_jabatan = KelompokJabatan::all();
        $disabilitas = Disabilitas::all();
        $besaran_upah = BesaranUpah::all();
        $kelurahan = Kelurahan::all();
        
        return view('admin.ak1.create', compact('agama', 'status_perkawinan', 'tingkat_pendidikan', 'kelompok_jabatan', 'disabilitas', 'besaran_upah', 'sektor_usaha', 'kelurahan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_agama' => 'required|integer',
            'id_kelurahan' => 'required|integer',
            'id_besaran_upah' => 'required|integer',
            'id_disabilitas' => 'nullable|integer',
            'id_kelompok_jabatan' => 'required|integer',
            'id_sektor_usaha' => 'required|integer',
            'id_status_perkawinan' => 'required|integer',
            'id_tingkat_pendidikan' => 'required|integer',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:permohonan_ak1',
            'nik' => 'required|string|max:16|unique:permohonan_ak1',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'tinggi_badan' => 'required|integer|min:100|max:250',
            'berat_badan' => 'required|integer|min:30|max:200',
            'jumlah_anak' => 'nullable|integer|min:0',
            'kendaraan' => 'nullable|string|max:100',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'tempat_tinggal' => 'required|string|max:255',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'kode_pos' => 'required|string|max:10',
            'no_hp' => 'required|string|max:15',
            'institusi_pendidikan' => 'required|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'tahun_lulus' => 'required|string|max:4',
            'nilai' => 'nullable|string|max:10',
            'jabatan_minat' => 'required|string|max:255',
            'lokasi_kerja' => 'required|string',
            'kota_negara_minat' => 'nullable|string|max:255',
            'keterangan_singkat_pengalaman' => 'nullable|string',
            'is_pernah_bekerja' => 'required|boolean',
            'file_foto' => 'nullable|file|mimes:jpg,png|max:2048',
            'file_ktp' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'file_ijazah' => 'nullable|file|mimes:pdf|max:2048',
            'file_transkrip' => 'nullable|file|mimes:pdf|max:2048',
            'file_ak1' => 'nullable|file|mimes:pdf|max:2048',
            'is_active' => 'required|boolean',
            'is_verified' => 'nullable|boolean'
        ]);

        // Persiapkan data
        $data = $request->all();

        $files = ['file_foto', 'file_ktp', 'file_ijazah', 'file_transkrip', 'file_ak1'];
        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $filename = time() . '_' . $request->file($file)->getClientOriginalName();
                $path = $request->file($file)->storeAs('uploads/ak1', 'tipe_' . $file . '_' . $filename, 'public');
                $data[$file] = $path;
            }
        }

        PermohonanAk1::create($data);
        return redirect()->route('ak1.index')->with('success', 'Data AK1 berhasil disimpan!');
    }

    public function edit($id)
    {
        $ak1 = PermohonanAk1::findOrFail($id);
        $agama = Agama::all();
        $status_perkawinan = StatusPerkawinan::all();
        $tingkat_pendidikan = TingkatPendidikan::all();
        $sektor_usaha = SektorUsaha::all();
        $kelompok_jabatan = KelompokJabatan::all();
        $disabilitas = Disabilitas::all();
        $besaran_upah = BesaranUpah::all();
        $kelurahan = Kelurahan::all();
        
        return view('admin.ak1.edit', compact('ak1', 'agama', 'status_perkawinan', 'tingkat_pendidikan', 'kelompok_jabatan', 'disabilitas', 'besaran_upah', 'sektor_usaha', 'kelurahan'));
    }

    public function show($id)
    {
        $ak1 = PermohonanAk1::with([
            'agama', 
            'kelurahan', 
            'besaranUpah', 
            'disabilitas', 
            'kelompokJabatan', 
            'sektorUsaha', 
            'statusPerkawinan', 
            'tingkatPendidikan'
        ])->findOrFail($id);
        
        return view('admin.ak1.show', compact('ak1'));
    }

    public function update(Request $request, $id)
    {
        $ak1 = PermohonanAk1::findOrFail($id);

        if ($request->is_active == 1) {
            $request->merge(['is_active' => true]);
        } else {
            $request->merge(['is_active' => false]);
        }
        
        if ($request->is_verified == 1) {
            $request->merge(['is_verified' => true]);
        } else {
            $request->merge(['is_verified' => false]);
        }
        
        $data = $request->validate([
            'id_agama' => 'required|integer',
            'id_kelurahan' => 'required|integer',
            'id_besaran_upah' => 'required|integer',
            'id_disabilitas' => 'nullable|integer',
            'id_kelompok_jabatan' => 'required|integer',
            'id_sektor_usaha' => 'required|integer',
            'id_status_perkawinan' => 'required|integer',
            'id_tingkat_pendidikan' => 'required|integer',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:permohonan_ak1,email,' . ($ak1->id ? $ak1->id : ''),
            'nik' => 'required|string|max:16|unique:permohonan_ak1,nik,' . ($ak1->id ? $ak1->id : ''),
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'tinggi_badan' => 'required|integer|min:100|max:250',
            'berat_badan' => 'required|integer|min:30|max:200',
            'jumlah_anak' => 'nullable|integer|min:0',
            'kendaraan' => 'nullable|string|max:100',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'tempat_tinggal' => 'required|string|max:255',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'kode_pos' => 'required|string|max:10',
            'no_hp' => 'required|string|max:15',
            'institusi_pendidikan' => 'required|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'tahun_lulus' => 'required|string|max:4',
            'nilai' => 'nullable|string|max:10',
            'jabatan_minat' => 'required|string|max:255',
            'lokasi_kerja' => 'required|string',
            'kota_negara_minat' => 'nullable|string|max:255',
            'keterangan_singkat_pengalaman' => 'nullable|string',
            'is_pernah_bekerja' => 'required|boolean',
            'file_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'file_ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_transkrip' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_ak1' => 'nullable|file|mimes:pdf|max:2048',
            'is_active' => 'required|boolean',
            'is_verified' => 'required|boolean'
        ]);

        $files = ['file_foto', 'file_ktp', 'file_ijazah', 'file_transkrip', 'file_ak1'];
        foreach ($files as $file) {            
            if ($request->hasFile($file)) {
                $old_file = $ak1->$file;
                if ($old_file) {
                    if (file_exists('storage/' . $old_file)) {
                        unlink('storage/' . $old_file);
                    }
                }

                $filename = time() . '_' . $request->file($file)->getClientOriginalName();
                $path = $request->file($file)->storeAs('uploads/ak1', 'tipe_' . $file . '_' . $filename, 'public');
                $data[$file] = $path;
            }
        }

        $ak1->update($data);
        return redirect()->route('ak1.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $ak1 = PermohonanAk1::findOrFail($id);
        $files = ['file_foto', 'file_ktp', 'file_ijazah', 'file_transkrip', 'file_ak1'];
        foreach ($files as $file) {
            $old_file = $ak1->$file;
            if ($old_file) {
                if (file_exists('storage/' . $old_file)) {
                    unlink('storage/' . $old_file);
                }
            }
        }

        PermohonanAk1::destroy($id);
        return redirect()->route('ak1.index')->with('success', 'Data berhasil dihapus!');
    }
}
