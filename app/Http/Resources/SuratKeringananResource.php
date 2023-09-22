<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SuratKeringananResource extends JsonResource
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
            'nama_usaha' =>$this->nama_usaha,
            'jenis_bangunan' =>$this->jenis_bangunan,
            'nama_penanggungjawab' =>$this->nama_penanggungjawab,
            'nik' =>$this->nik,
            'nomor_telpon' =>$this->nomor_telpon,
            'tarif_perda' =>$this->tarif_perda,
            'tarif_keringanan' =>$this->tarif_keringanan,
            'alasan' =>$this->alasan,
            'alamat' =>$this->alamat,
            'file_surat' =>$this->file_surat,
            'keterangan' =>$this->keterangan,
            'created_at' =>$this->created_at,
            'updated_at' =>$this->updated_at,

        ];
    }
}
