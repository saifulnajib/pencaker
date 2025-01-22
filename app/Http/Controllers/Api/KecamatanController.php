<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\KecamatanResource;

class KecamatanController extends ApiController
{
    
    public function option(Request $request): JsonResponse
    {
        $data = Kecamatan::select('id','name')->where('is_active', 1)->latest('updated_at')->with(['kelurahan'])->get();
        return $this->sendResponse($data, 'Data retrieved successfully.');
    }

}
