<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PengelolaanLimbah extends Model
{
    use HasFactory;
    use LogsActivity;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'pengelolaan_limbah';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'id_kegiatan_usaha', 'jenis_limbah',
        'kode_limbah', 'perizinan', 'nomor',
        'tahun', 'keterangan', 
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} Data Pengelolaan Limbah");
    }

    public function kegiatanUsaha(){
        return $this->belongsTo(KegiatanUsaha::class, 'id_kegiatan_usaha', 'id');
    }
}
