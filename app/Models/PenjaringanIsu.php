<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjaringanIsu extends Model
{
    use HasFactory;

    protected $table        = 'penjaringan_isu';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'file_banner',
        'started_at',
        'closed_at',
    ];
}
