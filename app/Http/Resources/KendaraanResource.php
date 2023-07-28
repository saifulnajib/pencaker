<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KendaraanResource extends JsonResource
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
            'nopol' => $this->nopol,
            'sopir' => $this->sopir,
            'id_jenis_kendaraan' => $this->jenis_kendaraan,
            'jenis_kendaraan' => $this->jenisKendaraan->jenis,
            'id_rute' => $this->rute,
            'rute' => $this->ruteKendaraan->rute,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
