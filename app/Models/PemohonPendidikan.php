<?php
namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemohonPendidikan extends Model
{
    use HasFactory;

    protected $table = 'pemohon_pendidikan'; // Nama tabel
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nik','id_tingkat_pendidikan', 'institusi_pendidikan', 'jurusan', 
        'tahun_lulus', 'nilai','file_ijazah', 
        'file_transkrip'
    ];

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    public function tingkatPendidikan()
    {
        return $this->belongsTo(TingkatPendidikan::class, 'id_tingkat_pendidikan');
    }

}
