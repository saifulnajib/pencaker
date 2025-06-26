<?php
namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemohonBiodata extends Model
{
    use HasFactory;

    protected $table = 'pemohon_biodata'; // Nama tabel
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_agama', 'id_kelurahan', 'id_disabilitas', 
        'id_status_perkawinan',  'nama', 'email', 'nik', 'tempat_lahir', 
        'tanggal_lahir', 'tinggi_badan', 'berat_badan', 'jumlah_anak', 
        'kendaraan', 'gender', 'tempat_tinggal', 'alamat', 'rt', 'rw', 
        'kode_pos', 'no_hp',  
        'file_foto', 'file_ktp',  'is_active'
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

    public function statusPerkawinan()
    {
        return $this->belongsTo(StatusPerkawinan::class, 'id_status_perkawinan');
    }

    public function disabilitas()
    {
        return $this->belongsTo(Disabilitas::class, 'id_disabilitas');
    }

}
