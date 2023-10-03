<?php

namespace App\Http\Controllers\Api;

use Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Isu;
use App\Models\JawabanIsu;
use App\Models\DetilJawabanIsu;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\IsuResource;
use App\Exports\IsuExport;

class IsuController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('size', 10);
        $data = Isu::with(['dimensi'])->filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, IsuResource::class), 'Data retrieved successfully.');
    }
    
    public function questioner(Request $request): JsonResponse
    {
        $data = Isu::with(['dimensi'])->filter();
        $data = $data->get();
        return $this->sendResponse(IsuResource::collection($data), 'Data retrieved successfully.');
    }
    
    public function postAnswer(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'token_opd' => 'required',
            'skala_pencemaran' => 'required',
            'skala_urgensi' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        try {
            $jawabanIsu = JawabanIsu::where('token_opd', $input['token_opd'])->first();
            if ($jawabanIsu) {
                $detilJawabanIsu = DetilJawabanIsu::where('id_jawaban_isu', $jawabanIsu->id)->first();
                if ($detilJawabanIsu) {
                    return $this->sendError('Data failed to create. Record exist');
                } else {
                    $skalaPencemaran = json_decode($input['skala_pencemaran'], true);
                    $skalaUrgensi = json_decode($input['skala_urgensi'], true);
                    if (count($skalaPencemaran) == count($skalaUrgensi)) {
                        foreach($skalaPencemaran as $key=>$value) {
                            DetilJawabanIsu::create([
                                "id_jawaban_isu" => $jawabanIsu->id,
                                "id_isu" => $key,
                                "skala_pencemaran" => $value,
                                "skala_urgensi" => $skalaUrgensi[$key],
                            ]);
                        }
                        return $this->sendResponse([], 'Data created successfully.');
                    } else {
                        return $this->sendError('Data failed to create. Input length not equal');
                    }
                }
            } else {
                return $this->sendError('Data failed to create. Token invalid');
            }
        } catch (Exception $e)  {
            return $this->sendError('Data failed to create.'.$e->getMessage());
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id_dimensi_isu' => 'required',
            'isu' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }
        
        $input['id_penjaringan_isu'] = 1;
        $data = Isu::create($input);

        return $this->sendResponse(new IsuResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = Isu::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new IsuResource($data), 'Data retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id_dimensi_isu' => 'required',
            'isu' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Isu::find($id);

        $data->id_dimensi_isu = $input['id_dimensi_isu'];
        $data->isu = $input['isu'];
        $data->justifikasi_pencemaran = $input['justifikasi_pencemaran'] ?? '';
        $data->justifikasi_urgensi = $input['justifikasi_urgensi'] ?? '';
        $data->kaitan_isu_rpjmd = $input['kaitan_isu_rpjmd'] ?? '';
        $data->kaitan_isu_klhs = $input['kaitan_isu_klhs'] ?? '';
        $data->kaitan_isu_tpb = $input['kaitan_isu_tpb'] ?? '';
        $data->save();

        return $this->sendResponse(new IsuResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = Isu::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }

    public function exportIsu(Request $request)
    {
        $tanggal = date('Y-m-d');

        if (!empty($request->query('tanggal'))) {
            $tanggal = $request->query('tanggal');
        }

        $exportTime = Carbon::parse("$tanggal")->locale('id-ID');

        $data = Isu::with(['dimensi'])->get();

        $data = [
            'data' => $data,
            'time' => $exportTime->translatedFormat('l / d F Y'),
            'bulan' => Str::upper($exportTime->translatedFormat('F')),
        ];
        
        $export_name = "Data-Isu-$tanggal.xlsx";

        return Excel::download(new IsuExport($data), $export_name);
    }
}
