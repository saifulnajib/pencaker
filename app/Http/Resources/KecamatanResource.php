<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KecamatanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);

        return [
            'id' =>$this->id,
            'name' =>$this->name,
            'is_active' =>$this->is_active,
            'kelurahan' => [
                'id'=> $this->kelurahan->id,
                'name' => $this->kelurahan->name,
            ],
            'created_at' =>$this->created_at,
            'updated_at' =>$this->updated_at,

        ];
    }
}
