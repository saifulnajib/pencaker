<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermohonanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'nama' =>$this->nama,
            'email' =>$this->email,
            'nik' =>$this->nik,
            'tempat_lahir' =>$this->tempat_lahir,
            'tanggal_lahir' =>$this->tanggal_lahir,
            'tinggi_badan' =>$this->tinggi_badan,
            'berat_badan' =>$this->berat_badan,
            'jumlah_anak' =>$this->jumlah_anak,
            'kendaraan' =>$this->kendaraan,
            'gender' =>$this->gender,
            'tempat_tinggal' =>$this->tempat_tinggal,
            'alamat' =>$this->alamat,
            'rt' =>$this->rt,
            'rw' =>$this->rw,
            'kode_pos' =>$this->kode_pos,
            'no_hp' =>$this->no_hp,
            'institusi_pendidikan' =>$this->institusi_pendidikan,
            'jurusan' =>$this->jurusan,
            'tahun_lulus' =>$this->tahun_lulus,
            'nilai' =>$this->nilai,
            'lokasi_kerja' =>$this->lokasi_kerja,
            'kota_negara_minat' =>$this->kota_negara_minat,
            'keterangan_singkat_pengalaman' =>$this->keterangan_singkat_pengalaman,
            'is_pernah_bekerja' =>$this->is_pernah_bekerja,
            'file_foto' =>$this->file_foto,
            'file_ktp' =>$this->file_ktp,
            'file_ijazah' =>$this->file_ijazah,
            'file_transkrip' =>$this->file_transkrip,
            'file_ak1' =>$this->file_ak1,
            'agama' =>[
                'id' => $this->agama->id,
                'name' => $this->agama->name,
            ],
            'kelurahan' =>[
                'id' => $this->kelurahan->id,
                'id_kecamatan' => $this->kelurahan->id_kecamatan,
                'name' => $this->kelurahan->name,
            ],
            'besaranUpah' =>[
                'id' => $this->besaranUpah->id,
                'min' => $this->besaranUpah->min,
                'max' => $this->besaranUpah->max,
            ],
            'disabilitas' =>[
                'id' => $this->disabilitas->id,
                'name' => $this->disabilitas->name,
            ],
            'kelompokJabatan' =>[
                'id' => $this->kelompokJabatan->id,
                'name' => $this->kelompokJabatan->name,
            ],
            'sektorUsaha' =>[
                'id' => $this->sektorUsaha->id,
                'name' => $this->sektorUsaha->name,
            ],
            'statusPerkawinan' =>[
                'id' => $this->statusPerkawinan->id,
                'name' => $this->statusPerkawinan->name,
            ],
            'tingkatPendidikan' =>[
                'id' => $this->tingkatPendidikan->id,
                'name' => $this->tingkatPendidikan->name,
            ],
            'is_verified' =>$this->is_verified,
            'is_active' =>$this->is_active,
            'created_at' =>$this->created_at,
            'updated_at' =>$this->updated_at,

        ];
    }
}
