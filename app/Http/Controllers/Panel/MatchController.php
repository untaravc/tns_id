<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\MatchModel;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatchController extends Controller
{
    public function index(Request $request)
    {
        $dataContent = MatchModel::orderByDesc('created_at');
        $dataContent = $this->withFilter($dataContent, $request);
        $dataContent = $dataContent->paginate($request->per_page ?? 20);

        $result = collect($this->response);
        return $result->merge($dataContent);
    }

    public function store(Request $request)
    {
        $this->validateData($request);

        $competition = Competition::find($request->competition_id);

        $player_ids = [];
        if ($request->home_first_player_id) $player_ids[] = $request->home_first_player_id;
        if ($request->home_second_player_id) $player_ids[] = $request->home_second_player_id;
        if ($request->away_first_player_id) $player_ids[] = $request->away_first_player_id;
        if ($request->away_second_player_id) $player_ids[] = $request->away_second_player_id;

        $players = Player::whereIn('id', $player_ids)->get();

        $request->merge([
            'competition_name'        => $competition->name,
            'user_id'                 => $request->user()['id'],
            'home_first_player_name'  => $request->home_first_player_id ? $players->where('id', $request->home_first_player_id)->first()['full_name'] : "",
            'home_second_player_name' => $request->home_second_player_id ? $players->where('id', $request->home_second_player_id)->first()['full_name'] : "",
            'away_first_player_name'  => $request->away_first_player_id ? $players->where('id', $request->away_first_player_id)->first()['full_name'] : "",
            'away_second_player_name' => $request->away_second_player_id ? $players->where('id', $request->away_second_player_id)->first()['full_name'] : "",
        ]);

        MatchModel::create($request->all());

        return $this->response;
    }

    public function show($id)
    {
        $data = MatchModel::find($id);

        $this->response['result'] = $data;
        return $this->response;
    }

    private function validateData($request)
    {
        if ($request->id) {
            // Update
            $validator = Validator::make($request->all(), [
                'competition_id'            => 'required',
                'player_category_code' => 'required',
                'winner'                    => 'required',
                'date'                      => 'required',
                'home_final_score'          => 'required',
                'home_first_player_id'      => 'required',
                'away_first_player_id'      => 'required',
                'away_final_score'          => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'competition_id'            => 'required',
                'player_category_code' => 'required',
                'winner'                    => 'required',
                'date'                      => 'required',
                'home_final_score'          => 'required',
                'home_first_player_id'      => 'required',
                'away_first_player_id'      => 'required',
                'away_final_score'          => 'required',
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

        $data = MatchModel::find($request->id);
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
        $data = MatchModel::where('id', '!=', 1)->find($id);

        if ($data) {
            $data->delete();
        }
        return $this->response;
    }
}
