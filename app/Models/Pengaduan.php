<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Pengaduan extends Model
{
    use HasFactory;
    use LogsActivity;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'pengaduan';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'nama', 'alamat', 'no_telpon', 'lokasi_kejadian',
        'jenis_kegiatan', 'nama_kegiatan', 'waktu_kejadian',
        'uraian_kejadian', 'dampak', 'penyelesaian', 'status'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} Data Pengaduan");
    }
}
