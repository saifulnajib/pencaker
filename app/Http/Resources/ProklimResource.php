<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProklimResource extends JsonResource
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
            'id_kategori' => $this->id_kategori,
            'kategori_proklim' => $this->kategoriProklim->kategori,
            'tahun_proklim' => $this->tahun_proklim,
            'kode_wilayah' => $this->kode_wilayah,
            'nama' => $this->nama,
            'no_registrasi' => $this->no_registrasi,
            'alamat' => $this->alamat,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'koordinat_y' => convertToDMS($this->latitude)->toHtml(),
            'koordinat_x' => convertToDMS($this->longitude, true)->toHtml(),
            'file_sertifikat' => $this->file_sertifikat,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
