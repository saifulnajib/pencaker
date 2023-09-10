<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JawabanIsu extends Model
{
    use HasFactory;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'jawaban_isu';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'id_penjaringan_isu',
        'opd',
        'token_opd',
    ];

    public function penjaringan(){
        return $this->belongsTo(PenjaringanIsu::class, 'id_penjaringan_isu', 'id');
    }

    public function detil(){
        return $this->hasMany(DetilJawabanIsu::class, 'id_jawaban_isu');
    }

}
