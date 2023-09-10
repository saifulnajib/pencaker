<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zonasi extends Model
{
    use HasFactory;

    protected $table        = 'zonasi';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'nama_zona', 'luas', 'keterangan', 'keterisian',
    ];
}
