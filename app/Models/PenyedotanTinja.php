<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PenyedotanTinja extends Model
{
    use HasFactory;
    use LogsActivity;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'penyedotan_tinja';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'id_kategori', 'nama',
        'nomor_karcis', 'nomor_telpon',
        'tanggal_penyedotan',
        'retribusi_penyedotan', 'retribusi_pembuangan',
        'alamat', 'keterangan','id_kendaraan'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} Data Penyedotan Tinja");
    }

    public function kategoriPenyedotan(){
        return $this->belongsTo(KategoriPenyedotan::class, 'id_kategori', 'id');
    }

    public function kendaraan(){
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan', 'id');
    }
}
