<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PengolahanKompos extends Model
{
    use HasFactory;
    use LogsActivity;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'pengolahan_kompos';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'id_kendaraan',
        'waktu_masuk', 'waktu_keluar',
        'berat_masuk', 'berat_keluar',
        'berat_isi', 'kompos_keluar',
        'keterangan'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} Data Pengolahan Kompos");
    }

    public function kendaraan(){
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan', 'id');
    }
}
