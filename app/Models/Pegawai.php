<?php

namespace App\Models;

use App\Models\Scopes\DataGridScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Pegawai extends Model
{
    use HasFactory;
    use LogsActivity;

    public function scopeFilter($query)
    {
        return (new DataGridScope())->apply($query, $this);
    }

    protected $table        = 'pegawai';
    protected $primaryKey   = 'id';
    // protected $keyType      = 'string';
    // public $incrementing    = false;
    protected $fillable = [
        'nama', 'nip', 'nik', 'no_sk',
        'tanggal_sk','tanggal_awal_kerja','jenis_pegawai','jenis_kelamin',
        'golongan','ruang','tmt','masa_kerja','nama_jabatan',
        'bidang','tmt_jabatan','nama_latihan','bulan_tahun_latihan',
        'lama_latihan','nama_pendidikan','lulusan_pendidikan','tingkat_ijazah_pendidikan',
        'tempat_lahir','tanggal_lahir','alamat','nomor_telpon',
        'no_bpjs','no_bpjs_tk','jenjang_pendidikan','jurusan_pendidikan','no_pbb','status_nikah',
        'gol_darah','agama','sertifikat_kompetensi','tugas_jabatan',
        'lokasi_kerja_pengawas','lokasi_kerja_pekerja','nama_korlap','nama_pengawas',
        'unit_kerja','status_keaktifan','tanggal_status_keaktifan','foto'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} Data Pegawai");
    }
}
