<?php

namespace App\Http\Resources\Base;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseCollection extends ResourceCollection
{
    protected $resourceClass;

    public function __construct($resource, $resourceClass)
    {
        $this->resourceClass = $resourceClass;
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = $this->collection->map(function ($item) {
            return new $this->resourceClass($item);
        });

        return [
            'data' => $data,
            'current_page' => $this->currentPage(),
            'last_page' => $this->lastPage(),
            'per_page' => $this->perPage(),
            'count' => $this->count(),
            'total' => $this->total(),
        ];
    }
}
