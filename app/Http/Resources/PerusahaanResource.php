<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PerusahaanResource extends JsonResource
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
            'name' => $this->name,
            'alamat' => $this->alamat,
            'telp' => $this->telp,
            'email' => $this->email,
            'is_active' => $this->is_active,
            'logo' => $this->logo ?? asset('login_asset/images/company.png'),
            'created_at' =>$this->created_at,
            'updated_at' =>$this->updated_at,

        ];
    }
}
