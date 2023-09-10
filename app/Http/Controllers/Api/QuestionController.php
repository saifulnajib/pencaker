<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use App\Models\JawabanSurvey;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\JawabanSurveyResource;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Controllers\Api\ApiController;

class QuestionController extends ApiController
{

    public function index(Request $request): JsonResponse
    {
        $surveyId = $request->query('survey_id', '');
        $perPage = $request->query('size', 10);
        $data = Question::with(['options'])->filter();
        if ($surveyId) {
            $data = $data->where('survey_id', $surveyId);
        }
        $data = $data->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, QuestionResource::class), 'Data retrieved successfully.');
    }

    public function survey(Request $request): JsonResponse
    {
        $surveyId = $request->query('survey_id', '');
        $data = Question::with(['options'])->filter();
        if ($surveyId) {
            $data = $data->where('survey_id', $surveyId);
        }
        $data = $data->get();
        return $this->sendResponse(QuestionResource::collection($data), 'Data retrieved successfully.');
    }

    public function postAnswer(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'jawaban' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        try {
            $data = JawabanSurvey::create($input);

            return $this->sendResponse(new JawabanSurveyResource($data), 'Data created successfully.');
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'survey_id' => 'required',
            'question_text' => 'required',
            'options' => 'required|array|min:2',
            'options.*.option_text' => 'required|string',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        try {
            $data = Question::create($input);

            foreach ($input['options'] as $answerOptions) {
                QuestionOption::create([
                    'question_id' => $data->id,
                    'option_text' => $answerOptions['option_text'],
                    'option_weight' => $answerOptions['option_weight'],
                ]);
            }

            return $this->sendResponse(new QuestionResource($data), 'Data created successfully.');
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }

    public function show($id): JsonResponse
    {
        $data = Question::with(['options'])->find($id);

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
            'options' => 'required|array|min:2',
            'options.*.option_text' => 'required|string',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Question::find($id);

        $data->survey_id = $input['survey_id'];
        $data->question_text = $input['question_text'];
        $data->save();

        foreach ($input['options'] as $answerOptions) {
            $opt = QuestionOption::find($answerOptions['id']);
            $opt->option_text = $answerOptions['option_text'];
            $opt->option_weight = $answerOptions['option_weight'];
            $opt->save();
        }

        return $this->sendResponse(new QuestionResource($data), 'Data updated successfully.');
    }

    public function destroy($id): JsonResponse
    {
        $data = Question::find($id);

        if($data) {
            QuestionOption::where('question_id')->delete();
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
