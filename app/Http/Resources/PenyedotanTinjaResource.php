<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PenyedotanTinjaResource extends JsonResource
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
            'id_kategori' =>$this->id_kategori,
            'kategori'=>$this->kategoriPenyedotan->kategori,
            'nama' =>$this->nama,
            'nomor_karcis' =>$this->nomor_karcis,
            'nomor_telpon' =>$this->nomor_telpon,
            'alamat' =>$this->alamat,
            'tanggal_penyedotan' =>$this->tanggal_penyedotan,
            'retribusi_penyedotan' =>$this->retribusi_penyedotan,
            'retribusi_pembuangan' =>$this->retribusi_pembuangan,
            'kendaraan' => [
                'nopol' => $this->kendaraan->nopol,
                'sopir' => $this->kendaraan->sopir,
                'jenis_kendaraan' => $this->kendaraan->jenisKendaraan->jenis,
                'rute' => $this->kendaraan->ruteKendaraan->rute,
            ],
            'keterangan' =>$this->keterangan,
            'created_at' =>$this->created_at,
            'updated_at' =>$this->updated_at,

        ];
    }
}
