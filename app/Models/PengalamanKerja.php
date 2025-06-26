<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengalamanKerja extends Model
{
    use HasFactory;

    protected $table = 'pengalaman_kerja';
    protected $fillable = ['id_permohonan', 'jabatan','uraian_tugas','lama_bekerja','nama_perusahaan','file'];

    public function permohonan(){
        return $this->belongsTo(PermohonanAK1::class, 'id_permohonan');
    }
}
