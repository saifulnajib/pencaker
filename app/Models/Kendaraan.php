<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table        = 'kendaraan';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'nopol', 'sopir',
        'jenis_kendaraan', 'rute',
        'is_active'
    ];

    public function jenisKendaraan(){
        return $this->belongsTo(JenisKendaraan::class, 'jenis_kendaraan', 'id');
    }

    public function ruteKendaraan(){
        return $this->belongsTo(Rute::class, 'rute', 'id');
    }
}
