<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PemilahanSampah extends Model
{
    use HasFactory;
    use LogsActivity;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'pemilahan_sampah';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'id_kendaraan',
        'waktu_masuk', 'waktu_keluar',
        'berat_masuk', 'berat_keluar',
        'berat_sampah', 'sumber_sampah',
        'keterangan'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} Data Pemilahan Sampah");
    }

    public function kendaraan(){
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan', 'id');
    }
}
