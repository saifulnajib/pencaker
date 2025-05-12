<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SektorUsaha extends Model
{
    use HasFactory;

    protected $table = 'master_sektor_usaha'; // Nama tabel di database
    protected $fillable = ['name', 'is_active']; // Field yang bisa diisi
}
