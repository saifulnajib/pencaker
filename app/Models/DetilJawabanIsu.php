<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class DetilJawabanIsu extends Model
{
    use HasFactory;
    use LogsActivity;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'detil_jawaban_isu';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'id_jawaban_isu',
        'id_isu',
        'skala_pencemaran',
        'skala_urgensi',
    ];



    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} Data Detil Jawaban Isu");
    }

    public function jawaban(){
        return $this->belongsTo(JawabanIsu::class, 'id_jawaban_isu', 'id');
    }

    public function isu(){
        return $this->belongsTo(Isu::class, 'id_isu', 'id');
    }

}
