<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TitikKoordinatResource extends JsonResource
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
            'nama_lokasi' => $this->nama ?? $this->nama_lokasi,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'alamat' =>$this->alamat,
        ];
    }
}