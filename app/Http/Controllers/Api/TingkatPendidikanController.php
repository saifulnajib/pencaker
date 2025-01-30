<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Illuminate\Http\Request;
use App\Models\TingkatPendidikan;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\TingkatPendidikanResource;

class TingkatPendidikanController extends ApiController
{
    
    public function option(Request $request): JsonResponse
    {
        $data = TingkatPendidikan::select('id', 'name','singkatan')->where('is_active', 1)->latest('updated_at')->get();
        return $this->sendResponse($data, 'Data retrieved successfully.');
    }

}
