<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sampah extends Model
{
    use HasFactory;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'sampah';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'id_kendaraan', 'id_jenis_sampah',
        'nomor_bak', 'nomor_karcis',
        'waktu_masuk', 'waktu_keluar',
        'jenis_retribusi', 'tarif_retribusi',
        'berat_masuk', 'berat_keluar',
        'berat_sampah', 'volume',
        'sumber_sampah', 'keterangan'
    ];

    public function kendaraan(){
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan', 'id');
    }

    public function jenisSampah(){
        return $this->belongsTo(JenisSampah::class, 'id_jenis_sampah', 'id');
    }
}
