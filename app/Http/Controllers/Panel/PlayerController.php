<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Services\UploadFileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlayerController extends Controller
{
    private $uploadFileService;

    function __consturctor()
    {
        $this->uploadFileService = new UploadFileService();
    }

    public function index(Request $request)
    {
        $dataContent = Player::orderByDesc('created_at');
        $dataContent = $this->withFilter($dataContent, $request);
        $dataContent = $dataContent->paginate($request->per_page ?? 20);

        $result = collect($this->response);
        return $result->merge($dataContent);
    }

    public function list(Request $request)
    {
        $this->response['result'] = Player::orderBy('full_name')
            ->when($request->name, function ($q) use ($request) {
                $q->where('full_name', 'LIKE', '%' . $request->name . '%');
            })
            ->whereStatus(1)
            ->get();

        return $this->response;
    }

    public function store(Request $request)
    {
        $this->validateData($request);
        Player::create($request->all());

        return $this->response;
    }

    public function show($id)
    {
        $data = Player::find($id);

        $this->response['result'] = $data;
        return $this->response;
    }

    private function validateData($request)
    {
        if ($request->id) {
            // Update
            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'reg_id'    => 'nullable|unique:players,reg_id,' . $request->id,
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'reg_id'    => 'nullable|unique:players,reg_id',
            ]);
        }

        if ($validator->fails()) {
            $this->response['errors'] = $validator->errors();
            abort(response($this->response, 422));
        }
    }

    private function withFilter($dataContent, $request)
    {
        if ($request->name) {
            $dataContent = $dataContent->where('players.full_name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->city) {
            $dataContent = $dataContent->where('players.city', 'LIKE', '%' . $request->city . '%');
        }
        if ($request->status !== null) {
            $dataContent = $dataContent->where('players.status', $request->status);
        }
        if ($request->gender) {
            $dataContent = $dataContent->where('players.gender', $request->gender);
        }
        return $dataContent;
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'id' => $id
        ]);

        $this->validateData($request);

        $data = Player::find($request->id);
        if ($data) {
            $data->update($request->all());
            $this->response['message'] = 'Updated!';
        } else {
            $this->response['success'] = false;
            $this->response['message'] = 'No Data';
        }

        return $this->response;
    }

    public function destroy($id)
    {
        $data = Player::find($id);

        if ($data) {
            $data->delete();
        }
        return $this->response;
    }
}
