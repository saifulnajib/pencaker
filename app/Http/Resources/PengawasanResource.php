<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PengawasanResource extends JsonResource
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
            'tanggal_pengawasan' => $this->tanggal_pengawasan,
            'temuan' => $this->temuan_pengawasan,
            'surat_tindaklanjut' => $this->surat_tindaklanjut,
            'rekomendasi' => $this->rekomendasi_hasil_pengawasan,
            'batas_waktu' => $this->batas_waktu_tindaklanjut,
            'id_kegiatan_usaha' => $this->id_kegiatan_usaha,
            'kegiatan_usaha' => $this->kegiatanUsaha,
            'tindaklanjut_usaha' => $this->tindaklanjut_usaha,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
