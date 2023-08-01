<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PemilahanSampahResource extends JsonResource
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
            'id_kendaraan' =>$this->id_kendaraan,
            'waktu_masuk' =>$this->waktu_masuk,
            'waktu_keluar' =>$this->waktu_keluar,
            'berat_masuk' =>$this->berat_masuk,
            'berat_keluar' =>$this->berat_keluar,
            'berat_sampah' =>$this->berat_sampah,
            'keterangan' =>$this->keterangan,
            'kendaraan' => [
                'nopol' => $this->kendaraan->nopol,
                'sopir' => $this->kendaraan->sopir,
                'jenis_kendaraan' => $this->kendaraan->jenisKendaraan->jenis,
                'rute' => $this->kendaraan->ruteKendaraan->rute,
            ],
            'created_at' =>$this->created_at,
            'updated_at' =>$this->updated_at,

        ];
    }
}
