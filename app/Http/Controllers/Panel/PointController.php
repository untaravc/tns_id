<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\Player;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PointController extends Controller
{
    public function index(Request $request)
    {
        $dataContent = Point::orderByDesc('created_at');
        $dataContent = $this->withFilter($dataContent, $request);
        $dataContent = $dataContent->paginate($request->per_page ?? 20);

        $result = collect($this->response);
        return $result->merge($dataContent);
    }

    public function store(Request $request)
    {
        $this->validateData($request);

        $player = Player::find($request->player_id);
        $competition = Competition::find($request->competition_id);
        $request->merge([
            'player_name'      => $player->full_name,
            'player_reg_id'    => $player->reg_id,
            'competition_name' => $competition->name,
            'user_id'          => $request->user()['id']
        ]);

        Point::create($request->all());

        return $this->response;
    }

    public function show($id)
    {
        $data = Point::find($id);

        $this->response['result'] = $data;
        return $this->response;
    }

    private function validateData($request)
    {
        if ($request->id) {
            // Update
            $validator = Validator::make($request->all(), [
                'player_id' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'player_id' => 'required',
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
            $dataContent = $dataContent->where('players.name', 'LIKE', '%' . $request->name . '%');
        }
        return $dataContent;
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'id' => $id
        ]);

        $this->validateData($request);

        $player = Player::find($request->player_id);
        $competition = Competition::find($request->competition_id);
        $request->merge([
            'player_name'      => $player->full_name,
            'player_reg_id'    => $player->reg_id,
            'competition_name' => $competition->name,
            'user_id'          => $request->user()['id']
        ]);

        $data = Point::find($request->id);
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
        $data = Point::find($id);

        if ($data) {
            $data->delete();
        }
        return $this->response;
    }

    public function pointReports(Request $request)
    {
        $points = Point::whereIsHistorical(0)
            ->where('player_category_code', $request->player_category_code)
            ->groupBy('player_id')
            ->selectRaw('SUM(point) as points, player_id, player_name, player_category_code')
            ->orderByDesc('points')
            ->get();

        $players = Player::whereIn('id', $points->pluck('player_id')->toArray())
            ->get();

        foreach ($points as $point) {
            $point->setAttribute('player', $players->where('id', $point->player_id)->first());
        }

        $this->response['result'] = $points;
        return $this->response;
    }
}
