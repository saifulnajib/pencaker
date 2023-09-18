<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PengaduanResource extends JsonResource
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
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'no_telpon' => $this->no_telpon,
            'lokasi_kejadian' => $this->lokasi_kejadian,
            'nama_kegiatan' => $this->nama_kegiatan,
            'jenis_kegiatan' => $this->jenis_kegiatan,
            'waktu_kejadian' => $this->waktu_kejadian,
            'uraian_kejadian' => $this->uraian_kejadian,
            'dampak' => $this->dampak,
            'penyelesaian' => $this->penyelesaian,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
