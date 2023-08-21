<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanUsaha extends Model
{
    use HasFactory;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'kegiatan_usaha';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'nama_usaha', 'nama_penanggungjawab',
        'alamat', 'dokumen_lh', 'file_dokumen_lh',
        'id_sektor', 'keterangan',
    ];

    public function sektorKegiatan(){
        return $this->belongsTo(SektorKegiatanUsaha::class, 'id_sektor', 'id');
    }
}
