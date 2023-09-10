<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LokasiPemantauanResource extends JsonResource
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
            'tanggal_pemantauan' => $this->tanggal_pemantauan,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'is_kualitas_udara' => $this->is_kualitas_udara,
            'is_kualitas_air_limbah' => $this->is_kualitas_air_limbah,
            'id_kegiatan_usaha' => $this->id_kegiatan_usaha,
            'kegiatan_usaha' => $this->kegiatanUsaha,
            'parameter_ika' => $this->parameter_ika,
            'parameter_iku' => $this->parameter_iku,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
