<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RiwayatKgbResource extends JsonResource
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
            'id_pegawai' => $this->id_pegawai,
            'nama_pegawai'=> $this->dataPegawai->nama,
            'nip'=> $this->dataPegawai->nip,
            'no_kgb' => $this->no_kgb,
            'tanggal_kgb' => $this->tanggal_kgb,
            'tanggal_berakhir_kgb' => $this->tanggal_berakhir_kgb,
            'keterangan' => $this->keterangan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
