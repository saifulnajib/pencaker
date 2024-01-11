<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Module;
use App\Models\Acls;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Base\BaseCollection;
use App\Http\Resources\GroupResource;

class GroupController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = request()->query('size', 10);
        $data = Group::filter()->paginate($perPage);
        return $this->sendResponse(new BaseCollection($data, GroupResource::class), 'Data retrieved successfully.');
    }

    /**
     * Display a listing of the resource for dropdown.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function option(Request $request): JsonResponse
    {
        $data = Group::select('id', 'name')->where('is_active', 1)->latest('updated_at')->get();
        return $this->sendResponse($data, 'Data retrieved successfully.');
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
            'name' => 'required',
            'deskripsi' => 'required',
            'is_active' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

       
        DB::beginTransaction();
        try {
            $data = Group::create($input);
            $group_id = $data->id;
            $modules = Module::select('id')->get();
            $acls = [];
            foreach($modules as $key=>&$val){
                $acls[$key] = array(
                    "module_id" => $val['id'],
                    "group_id" => $group_id,
                );
            }
            $create_acl = Acls::insert($acls);
            DB::commit();
            $create = true;
        } catch(\Exception $e) {
            DB::rollback();
            $create = false;
        }

        return $this->sendResponse(new GroupResource($data), 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = Group::find($id);

        if (is_null($data)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse(new GroupResource($data), 'Data retrieved successfully.');
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
            'name' => 'required',
            'deskripsi' => 'required',
            'is_active' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $data = Group::find($id);

        $data->name = $input['name'];
        $data->deskripsi = $input['deskripsi'];
        $data->is_active = $input['is_active'];
        $data->save();

        return $this->sendResponse(new GroupResource($data), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $data = Group::find($id);

        if($data) {
            $data->delete();
        } else {
            return $this->sendError('Unable to delete data. No matching record found');
        }

        return $this->sendResponse([], 'Data deleted successfully.');
    }
}
