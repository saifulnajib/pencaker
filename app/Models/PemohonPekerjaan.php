<?php
namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemohonPekerjaan extends Model
{
    use HasFactory;

    protected $table = 'pemohon_pekerjaan'; // Nama tabel
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [ 'nik','id_besaran_upah', 
        'id_kelompok_jabatan', 'id_sektor_usaha', 'jabatan_minat', 'lokasi_kerja', 
        'kota_negara_minat','is_pernah_bekerja',
    ];

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    public function besaranUpah()
    {
        return $this->belongsTo(BesaranUpah::class, 'id_besaran_upah');
    }

    public function kelompokJabatan()
    {
        return $this->belongsTo(KelompokJabatan::class, 'id_kelompok_jabatan');
    }

    public function sektorUsaha()
    {
        return $this->belongsTo(SektorUsaha::class, 'id_sektor_usaha');
    }

    public function pengalaman(){
        return $this->hasMany(PemohonPengalamanKerja::class, 'nik');
    }

}
