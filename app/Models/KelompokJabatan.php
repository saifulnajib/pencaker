<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokJabatan extends Model
{
    use HasFactory;

    protected $table = 'master_kelompok_jabatan'; // Sesuai nama tabel di database

    protected $fillable = [
        'name',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
