<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PemohonPendidikanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nik' =>$this->nik,
            'institusi_pendidikan' =>$this->institusi_pendidikan,
            'jurusan' =>$this->jurusan,
            'tahun_lulus' =>$this->tahun_lulus,
            'nilai' =>$this->nilai,
            'file_ijazah' =>$this->file_ijazah,
            'file_transkrip' =>$this->file_transkrip,
            'tingkatPendidikan' =>[
                'id' => $this->tingkatPendidikan->id,
                'name' => $this->tingkatPendidikan->name,
            ],
            'created_at' =>$this->created_at,
            'updated_at' =>$this->updated_at,

        ];
    }
}
