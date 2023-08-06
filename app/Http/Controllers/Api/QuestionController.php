<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;

class QuestionController extends ApiController
{
    
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = Question::filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, QuestionResource::class), 'Data retrieved successfully.');
    }
    
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'survey_id' => 'required',
            'question_text' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        try {
            $data = Question::create($input);

            return $this->sendResponse(new QuestionResource($data), 'Data created successfully.');
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }
    
    public function show($id): JsonResponse
    {
        $data = Question::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new QuestionResource($data), 'Data retrieved successfully.');
    }
    
    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'survey_id' => 'required',
            'question_text' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Question::find($id);

        $data->survey_id = $input['survey_id'];
        $data->question_text = $input['question_text'];
        $data->save();

        return $this->sendResponse(new QuestionResource($data), 'Data updated successfully.');
    }
    
    public function destroy($id): JsonResponse
    {
        $data = Question::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
