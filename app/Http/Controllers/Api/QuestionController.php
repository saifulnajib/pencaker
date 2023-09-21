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

    public function hitung(Request $request): JsonResponse
    {
        $surveyId = $request->query('survey_id', '1');
        $data = Question::where('survey_id', $surveyId)->get();
        $jawaban = JawabanSurvey::where('survey_id', $surveyId)->get();
        $answerMatrix = [];
        $params = [
            "n_parameter" => count($data) ?? 0,
            "n_responden" => count($jawaban) ?? 0,
            "weight" => 1/count($data) ?? 0,
        ];

        // Iterate through the questions
        foreach ($data as $question) {
            $questionId = $question['id'];
            $questionText = $question['question_text'];

            // Initialize an array to store answers for the current question
            $answersForQuestion = [];

            // Iterate through the answers
            foreach ($jawaban as $answer) {
                $answers = json_decode($answer['jawaban'], true);
                // Check if the current answer has a response for the current question
                if (isset($answers[$questionId])) {
                    $answersForQuestion[] = intval($answers[$questionId]);
                }
            }

            $jp = array_sum($answersForQuestion) ?? 0;
            $nrr = ($jp / $params['n_responden']) ?? 0;
            $skm = ($params['weight'] * $nrr) ?? 0;

            // Add the answers for the current question to the matrix
            $answerMatrix[] = [
                'question_id' => $questionId,
                'question_text' => $questionText,
                'answers' => $answersForQuestion,
                'jp' => $jp,
                'nrr' => $nrr,
                'skm' => $skm,
            ];
        }

        $ikm_unit = array_sum(array_column($answerMatrix,'skm')) ?? 0;
        $ikm_unit = round($ikm_unit, 2);
        $ikm = $ikm_unit * 25;
        $ikm = round($ikm, 2);
        $mutu = "";
        $predikat = "";
        if (1 <= $ikm_unit && $ikm_unit <= 1.75) {
            $mutu = "D";
            $predikat = "Tidak Baik";
        } else if (1.76 <= $ikm_unit && $ikm_unit <= 2.5) {
            $mutu = "C";
            $predikat = "Kurang Baik";
        } else if (2.51 <= $ikm_unit && $ikm_unit <= 3.25) {
            $mutu = "B";
            $predikat = "Baik";
        } else {
            $mutu = "A";
            $predikat = "Sangat Baik";
        }
        $result = [
            "ikm_unit" => $ikm_unit,
            "ikm" => $ikm,
            "predikat" => $predikat,
            "mutu" => $mutu,
        ];

        return $this->sendResponse(["params"=>$params, "result" => $result, "matrix"=>$answerMatrix], 'Data retrieved successfully.');
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
