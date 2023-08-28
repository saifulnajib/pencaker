<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KegiatanUsahaResource extends JsonResource
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
            'nama_usaha' => $this->nama_usaha,
            'nama_penanggungjawab' => $this->nama_penanggungjawab,
            'alamat' => $this->alamat,
            'dokumen_lh' => $this->dokumen_lh,
            'file_dokumen_lh' => $this->file_dokumen_lh,
            'id_sektor' => $this->id_sektor,
            'sektor_kegiatan' => $this->sektorKegiatan->sektor,
            'keterangan' => $this->keterangan,
            'pelaksanaan_pengawasan' => $this->pelaksanaan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
