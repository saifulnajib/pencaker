<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PemohonPengalamanKerjaResource extends JsonResource
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
            'nik' =>$this->nik,
            'jabatan' =>$this->jabatan,
            'uraian_tugas' =>$this->uraian_tugas,
            'lama_bekerja' =>$this->lama_bekerja,
            'tahun_mulai' =>$this->tahun_mulai,
            'tahun_selesai' =>$this->tahun_selesai,
            'nama_perusahaan' =>$this->nama_perusahaan,
            'file' =>$this->file,
            'created_at' =>$this->created_at,
            'updated_at' =>$this->updated_at,

        ];
    }
}
