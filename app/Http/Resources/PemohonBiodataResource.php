<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PemohonBiodataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nik' =>$this->nik,
            'nama' =>$this->nama,
            'email' =>$this->email,
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
            'file_foto' =>$this->file_foto,
            'file_ktp' =>$this->file_ktp,
            'agama' =>[
                'id' => $this->agama->id,
                'name' => $this->agama->name,
            ],
            'kelurahan' =>[
                'id' => $this->kelurahan->id,
                'id_kecamatan' => $this->kelurahan->id_kecamatan,
                'name' => $this->kelurahan->name,
            ],
            'disabilitas' =>[
                'id' => $this->disabilitas->id,
                'name' => $this->disabilitas->name,
            ],
            'statusPerkawinan' =>[
                'id' => $this->statusPerkawinan->id,
                'name' => $this->statusPerkawinan->name,
            ],
            'is_active' =>$this->is_active,
            'created_at' =>$this->created_at,
            'updated_at' =>$this->updated_at,

        ];
    }
}
