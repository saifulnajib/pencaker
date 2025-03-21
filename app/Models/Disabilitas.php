<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disabilitas extends Model
{
    use HasFactory;

    protected $table = 'master_disabilitas'; // Sesuaikan dengan nama tabel di database
    protected $fillable = ['name', 'is_active']; // Kolom yang bisa diisi
}
