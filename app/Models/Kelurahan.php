<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    protected $table = 'kelurahans'; // Nama tabel di database

    protected $fillable = [
        'id_kecamatan',
        'name',
        'is_active',
    ];

    // Relasi ke Kecamatan
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }
}
