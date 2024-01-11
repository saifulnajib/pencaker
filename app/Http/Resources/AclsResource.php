<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AclsResource extends JsonResource
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
            'module_id' =>$this->module_id,
            'group_id' =>$this->group_id,
            'read' =>$this->read,
            'create' =>$this->create,
            'update' =>$this->update,
            'delete' => $this->delete,
            'approve' =>$this->approve,
            'module' =>$this->module,

        ];
    }
}
