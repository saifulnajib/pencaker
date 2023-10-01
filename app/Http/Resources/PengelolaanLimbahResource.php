<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PengelolaanLimbahResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'id_kegiatan_usaha' => $this->id_kegiatan_usaha,
            'kegiatan_usaha' => $this->kegiatanUsaha,
            'jenis_limbah' => $this->jenis_limbah,
            'kode_limbah' => $this->kode_limbah,
            'perizinan' => $this->perizinan,
            'nomor' => $this->nomor,
            'tahun' => $this->tahun,
            'keterangan' => $this->keterangan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
