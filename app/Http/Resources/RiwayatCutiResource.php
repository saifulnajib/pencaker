<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RiwayatCutiResource extends JsonResource
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
            'kategori_cuti' => $this->kategori_cuti,
            'alasan_cuti' => $this->alasan_cuti,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'lama' => $this->lama,
            'sisa' => $this->sisa,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
