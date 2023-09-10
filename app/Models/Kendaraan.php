<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kendaraan extends Model
{
    use HasFactory;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

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
    
    public function sampahMasuk(){
        return $this->hasMany(Sampah::class, 'id_kendaraan');
    }
}
