<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Pengawasan extends Model
{
    use HasFactory;
    use LogsActivity;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'pengawasan';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'tanggal_pengawasan', 'temuan_pengawasan',
        'surat_tindaklanjut', 'rekomendasi_hasil_pengawasan', 'batas_waktu_tindaklanjut',
        'id_kegiatan_usaha', 'tindaklanjut_usaha', 'status_pengawasan',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} Data Pengawasan");
    }

    public function kegiatanUsaha(){
        return $this->belongsTo(KegiatanUsaha::class, 'id_kegiatan_usaha', 'id');
    }
}
