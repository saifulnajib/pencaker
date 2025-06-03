<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'master_kecamatan'; // Nama tabel di database

    protected $fillable = ['name', 'is_active'];

    public $timestamps = true; // Menggunakan created_at & updated_at

    // Relasi ke kelurahan
    public function kelurahan()
    {
        return $this->hasMany(Kelurahan::class, 'id_kecamatan');
    }
}
