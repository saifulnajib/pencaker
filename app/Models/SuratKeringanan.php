<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SuratKeringanan extends Model
{
    use HasFactory;
    use LogsActivity;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'surat_keringanan';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'nama_usaha', 'jenis_bangunan',
        'nama_penanggungjawab','nik', 'nomor_telpon',
        'tarif_perda','tarif_keringanan', 'alasan',
        'alamat','file_surat', 'keterangan'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} Data Surat Keringanan");
    }
}
