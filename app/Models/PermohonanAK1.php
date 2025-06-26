<?php
namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanAK1 extends Model
{
    use HasFactory;

    protected $table = 'permohonan_ak1'; // Nama tabel

    protected $fillable = [
        'id_agama', 'id_kelurahan', 'id_besaran_upah', 'id_disabilitas', 
        'id_kelompok_jabatan', 'id_sektor_usaha', 'id_status_perkawinan', 
        'id_tingkat_pendidikan', 'nama', 'email', 'nik', 'tempat_lahir', 
        'tanggal_lahir', 'tinggi_badan', 'berat_badan', 'jumlah_anak', 
        'kendaraan', 'gender', 'tempat_tinggal', 'alamat', 'rt', 'rw', 
        'kode_pos', 'no_hp', 'institusi_pendidikan', 'jurusan', 
        'tahun_lulus', 'nilai', 'jabatan_minat', 'lokasi_kerja', 
        'kota_negara_minat', 'keterangan_singkat_pengalaman', 
        'is_pernah_bekerja', 'file_foto', 'file_ktp', 'file_ijazah', 
        'file_transkrip', 'file_ak1', 'is_active', 'is_verified'
    ];

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    // Relasi ke tabel master masing-masing
    public function agama()
    {
        return $this->belongsTo(Agama::class, 'id_agama');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan');
    }

    public function besaranUpah()
    {
        return $this->belongsTo(BesaranUpah::class, 'id_besaran_upah');
    }

    public function tingkatPendidikan()
    {
        return $this->belongsTo(TingkatPendidikan::class, 'id_tingkat_pendidikan');
    }

    public function statusPerkawinan()
    {
        return $this->belongsTo(StatusPerkawinan::class, 'id_status_perkawinan');
    }

    public function kelompokJabatan()
    {
        return $this->belongsTo(KelompokJabatan::class, 'id_kelompok_jabatan');
    }

    public function sektorUsaha()
    {
        return $this->belongsTo(SektorUsaha::class, 'id_sektor_usaha');
    }

    public function disabilitas()
    {
        return $this->belongsTo(Disabilitas::class, 'id_disabilitas');
    }

    public function pengalamanKerja()
    {
        return $this->hasMany(PengalamanKerja::class, 'id_permohonan');
    }

}
