<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Illuminate\Http\Request;
use App\Models\BesaranUpah;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\BesaranUpahResource;

class BesaranUpahController extends ApiController
{
    
    public function option(Request $request): JsonResponse
    {
        $data = BesaranUpah::select('id', 'min','max')->where('is_active', 1)->latest('updated_at')->get();
        return $this->sendResponse($data, 'Data retrieved successfully.');
    }

}
