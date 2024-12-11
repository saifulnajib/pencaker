<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LokerResource extends JsonResource
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
            'posisi' =>$this->posisi,
            'deskripsi' =>$this->deskripsi,
            'kualifikasi' =>$this->kualifikasi,
            'lokasi' =>$this->lokasi,
            'gaji' =>$this->gaji,
            'expired' =>$this->expired,
            'is_active' =>$this->is_active,
            'perusahaan' => [
                'name' => $this->perusahaan->name,
                'alamat' => $this->perusahaan->alamat,
                'telp' => $this->perusahaan->telp,
                'email' => $this->perusahaan->email,
                'logo' => $this->perusahaan->logo,
            ],
            'created_at' =>$this->created_at,
            'updated_at' =>$this->updated_at,

        ];
    }
}
