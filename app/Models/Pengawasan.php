<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengawasan extends Model
{
    use HasFactory;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'pengawasan';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'tanggal_pengawasan', 'temuan_pengawasan',
        'surat_tindaklanjut', 'rekomendasi_hasil_pengawasan', 'batas_waktu_tindaklanjut',
        'id_kegiatan_usaha', 'tindaklanjut_usaha',
    ];

    public function kegiatanUsaha(){
        return $this->belongsTo(KegiatanUsaha::class, 'id_kegiatan_usaha', 'id');
    }
}
