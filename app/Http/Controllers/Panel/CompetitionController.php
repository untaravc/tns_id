<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\MatchModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompetitionController extends Controller
{
    public function index(Request $request)
    {
        $dataContent = Competition::orderByDesc('status')->orderByDesc('date_start');
        $dataContent = $this->withFilter($dataContent, $request);
        $dataContent = $dataContent
            ->paginate($request->per_page ?? 20);

        $result = collect($this->response);
        return $result->merge($dataContent);
    }
    public function list(Request $request)
    {
        $this->response['result'] = Competition::orderBy('name')
            ->when($request->name, function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            })
            ->whereStatus(1)
            ->get();

        return $this->response;
    }
    public function store(Request $request)
    {
        $this->validateData($request);

        Competition::create($request->all());

        return $this->response;
    }

    public function show($id)
    {
        $data = Competition::find($id);

        $this->response['result'] = $data;
        return $this->response;
    }

    private function validateData($request)
    {
        if ($request->id) {
            // Update
            $validator = Validator::make($request->all(), [
                'name'     => 'required',
                'competition_category_code'     => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name'     => 'required',
                'competition_category_code'     => 'required',
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
            $dataContent = $dataContent->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->year) {
            $dataContent = $dataContent->whereYear('date_start', $request->year);
        }

        if ($request->city) {
            $dataContent = $dataContent->where('address', 'LIKE', '%' . $request->city . '%');
        }

        if ($request->status) {
            $dataContent = $dataContent->where('status', $request->status == 'aktif' ? 1 : 0);
        }
        return $dataContent;
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'id' => $id
        ]);

        $this->validateData($request);

        $data = Competition::find($request->id);
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
        $data = Competition::find($id);

        if ($data) {
            $data->delete();
        }
        return $this->response;
    }

    public function updateStatus()
    {
        $competitions = Competition::get();

        foreach ($competitions as $competition) {
            $match = MatchModel::where('competition_id', $competition->id)->first();

            if ($match) {
                $competition->update(['status' => 1]);
            } else {
                $competition->update(['status' => 0]);
            }
        }
    }
}
