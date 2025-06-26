<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PemohonPekerjaanResource extends JsonResource
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
            'lokasi_kerja' =>$this->lokasi_kerja,
            'jabatan_minat' =>$this->jabatan_minat,
            'kota_negara_minat' =>$this->kota_negara_minat,
            'is_pernah_bekerja' =>$this->is_pernah_bekerja,
            'besaranUpah' =>[
                'id' => $this->besaranUpah->id,
                'min' => $this->besaranUpah->min,
                'max' => $this->besaranUpah->max,
            ],
            'kelompokJabatan' =>[
                'id' => $this->kelompokJabatan->id,
                'name' => $this->kelompokJabatan->name,
            ],
            'sektorUsaha' =>[
                'id' => $this->sektorUsaha->id,
                'name' => $this->sektorUsaha->name,
            ],
            'created_at' =>$this->created_at,
            'updated_at' =>$this->updated_at,

        ];
    }
}
