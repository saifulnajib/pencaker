<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Isu extends Model
{
    use HasFactory;
    use LogsActivity;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'isu';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'isu', 'id_dimensi_isu', 'id_penjaringan_isu',
        'justifikasi_pencemaran', 'justifikasi_urgensi',
        'kaitan_isu_rpjmd', 'kaitan_isu_klhs',
        'kaitan_isu_tpb',
    ];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} Data Isu");
    }

    public function dimensi(){
        return $this->belongsTo(DimensiIsu::class, 'id_dimensi_isu', 'id');
    }

    public function penjaringan(){
        return $this->belongsTo(PenjaringanIsu::class, 'id_penjaringan_isu', 'id');
    }
}
