<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function pelaksanaanPengawasan(){
        return $this->hasMany(Pengawasan::class, 'id_kegiatan_usaha');
    }

    protected function getPostThumbnailBySize(): String {
        $pelaksanaan = $this->pelaksanaanPengawasan()->pluck('tanggal_pengawasan')->implode(',');
        return $pelaksanaan;
    }

    public function pelaksanaan(): Attribute {
        return Attribute::make(
            get: fn () => $this->getPostThumbnailBySize(),
        );
    }
}
