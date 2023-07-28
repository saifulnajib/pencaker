<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SampahResource extends JsonResource
{
    public $preserveKeys = true;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'id_kendaraan' => $this->id_kendaraan,
            'id_jenis_sampah' => $this->id_jenis_sampah,
            'jenis_sampah' => $this->jenisSampah->jenis,
            'nomor_bak' => $this->nomor_bak,
            'nomor_karcis' => $this->nomor_karcis,
            'waktu_masuk' => $this->waktu_masuk,
            'waktu_keluar' => $this->waktu_keluar,
            'jenis_retribusi' => $this->jenis_retribusi,
            'tarif_retribusi' => $this->tarif_retribusi,
            'berat_masuk' => $this->berat_masuk,
            'berat_keluar' => $this->berat_keluar,
            'berat_sampah' => $this->berat_sampah,
            'berat_sampah_ton' => $this->berat_sampah / 1000,
            'volume' => $this->volume,
            'sumber_sampah' => $this->sumber_sampah,
            'kendaraan' => [
                'nopol' => $this->kendaraan->nopol,
                'sopir' => $this->kendaraan->sopir,
                'jenis_kendaraan' => $this->kendaraan->jenisKendaraan->jenis,
                'rute' => $this->kendaraan->ruteKendaraan->rute,
            ],
            'keterangan' => $this->keterangan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
