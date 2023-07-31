<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SuratRetribusiResource extends JsonResource
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
            'nama_pemohon' =>$this->nama_pemohon,
            'nama_usaha' =>$this->nama_usaha,
            'jenis_usaha' =>$this->jenis_usaha,
            'alamat_usaha' =>$this->alamat_usaha,
            'nomor_telpon' =>$this->nomor_telpon,
            'tarif_retribusi' =>$this->tarif_retribusi,
            'created_id' =>$this->created_id,
            'updated_at' =>$this->updated_at,

        ];
    }
}
