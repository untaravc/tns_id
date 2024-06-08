<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $dataContent = Setting::orderByDesc('name');
        $dataContent = $this->withFilter($dataContent, $request);
        $dataContent = $dataContent->paginate($request->per_page ?? 20);

        $result = collect($this->response);
        return $result->merge($dataContent);
    }

    public function withFilter($dataContent, $request)
    {
        if ($request->name) {
            $dataContent = $dataContent->where('name', 'LIKE', '%' . $request->name . '%');
        }
        return $dataContent;
    }

    public function store(Request $request)
    {
        $this->validateData($request);

        $this->response['result'] = Setting::create($request->all());

        return $this->response;
    }

    public function validateData($request)
    {
        $validator = Validator::make($request->all(), [
            'type'      => 'required',
            'name'      => 'required',
            'value'      => 'required',
            'title'      => 'required',
        ]);

        if ($validator->fails()) {
            $this->response['errors'] = $validator->errors();
            abort(response($this->response, 422));
        }
    }

    public function update(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $this->validateData($request);

        $data = Setting::find($request->id);
        if ($data) {
            $data->update($request->all());
            $this->response['message'] = 'Updated!';
        } else {
            $this->response['success'] = false;
            $this->response['message'] = 'Not Found';
        }

        return $this->response;
    }

    public function show($id)
    {
        $data = Setting::find($id);

        $this->response['result'] = $data;
        return $this->response;
    }

    public function destroy($id)
    {
        $data = Setting::find($id);
        if($data){
           $data->delete();
        }
        return $this->response;
    }
}
