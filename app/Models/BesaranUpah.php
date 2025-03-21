<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BesaranUpah extends Model
{
    use HasFactory;

    protected $table = 'master_besaran_upah'; // Sesuai nama tabel di database

    protected $fillable = [
        'min',
        'max',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
