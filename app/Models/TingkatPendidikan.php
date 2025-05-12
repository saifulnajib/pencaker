<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TingkatPendidikan extends Model
{
    use HasFactory;

    protected $table = 'master_tingkat_pendidikan'; // Nama tabel di database
    protected $fillable = ['name', 'singkatan', 'is_active'];
}
