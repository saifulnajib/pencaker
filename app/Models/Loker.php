<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Loker extends Model
{
    use HasFactory;
    // use LogsActivity;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'lokers';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;s
    protected $fillable = [
        'id_perusahaan',
        'posisi',
        'deskripsi',
        'kualifikasi',
        'lokasi',
        'gaji',
        'gambar',
        'expired',
        'is_active',
    ];

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //     ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} Data Kendaraan");
    // }

    public function perusahaan()
{
    return $this->belongsTo(Perusahaan::class, 'id_perusahaan');
}


    // Tambahkan relasi ke Perusahaan
    // public function perusahaan()
    // {
    //     return $this->belongsTo(Perusahaan::class, 'perusahaan');
    // }
}



