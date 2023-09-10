<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HasilPemantauanResource extends JsonResource
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
            'id_kegiatan_usaha' => $this->id_kegiatan_usaha,
            'nama_usaha' => $this->kegiatanUsaha->nama_usaha . ' / ' . $this->kegiatanUsaha->alamat,
            'parameter_ika' => json_decode($this->parameter_ika, true),
            'parameter_iku' => json_decode($this->parameter_iku, true),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
