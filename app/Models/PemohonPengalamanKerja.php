<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemohonPengalamanKerja extends Model
{
    use HasFactory;

    protected $table = 'pemohon_pengalaman_kerja';
    protected $fillable = ['nik', 'jabatan','uraian_tugas','tahun_mulai','tahun_selesai','lama_bekerja','nama_perusahaan','file'];

    // public function pengalaman(){
    //     return $this->belongsTo(PemohonPekerjaan::class, 'nik');
    // }
}
