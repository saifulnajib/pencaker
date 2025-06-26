<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PengalamanKerjaResource extends JsonResource
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
            'id_permohonan' =>$this->id_permohonan,
            'jabatan' =>$this->jabatan,
            'uraian_tugas' =>$this->uraian_tugas,
            'lama_bekerja' =>$this->lama_bekerja,
            'nama_perusahaan' =>$this->nama_perusahaan,
            'file' =>$this->file,
            'created_at' =>$this->created_at,
            'updated_at' =>$this->updated_at,

        ];
    }
}
