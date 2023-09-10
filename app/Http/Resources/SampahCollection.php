<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SampahCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => SampahResource::collection($this->collection),
            'current_page' => $this->currentPage(),
            'last_page' => $this->lastPage(),
            'per_page' => $this->perPage(),
            'count' => $this->count(),
            'total' => $this->total(),
        ];
    }
}