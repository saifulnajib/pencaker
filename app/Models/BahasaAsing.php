<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahasaAsing extends Model
{
    use HasFactory;

    protected $table = 'master_bahasa_asing'; // Nama tabel di database
    protected $fillable = ['name', 'is_active'];
}
