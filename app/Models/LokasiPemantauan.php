<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class LokasiPemantauan extends Model
{
    use HasFactory;
    use LogsActivity;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'lokasi_pemantauan';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'tanggal_pemantauan', 'latitude', 'longitude',
        'is_kualitas_udara', 'is_kualitas_air_limbah', 'id_kegiatan_usaha',
        'parameter_ika', 'parameter_iku'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} Data Lokasi Pemantauan");
    }

    public function kegiatanUsaha(){
        return $this->belongsTo(KegiatanUsaha::class, 'id_kegiatan_usaha', 'id');
    }
}
