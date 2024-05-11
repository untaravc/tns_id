<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\MatchDetail;
use App\Models\MatchModel;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatchController extends Controller
{
    public function index(Request $request)
    {
        $dataContent = MatchModel::orderByDesc('date')
            ->with(['match_detail', 'match_type', 'round_category', 'player_category']);
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

        $data = MatchModel::create($request->all());

        $match_detail_req = $request->match_detail;
        $match_detail_req['match_id'] = $data->id;

        $match_detail = MatchDetail::whereMatchId($data->id)->first();

        if ($match_detail) {
            $match_detail->update($match_detail_req);
        } else {
            MatchDetail::create($match_detail_req);
        }

        return $this->response;
    }

    public function show($id)
    {
        $data = MatchModel::with('match_detail')->find($id);

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
        if ($request->player_id) {
            $dataContent = $dataContent->where(function ($q) use ($request) {
                $q->where('home_first_player_id', $request->player_id)
                    ->orWhere('home_second_player_id', $request->player_id)
                    ->orWhere('away_first_player_id', $request->player_id)
                    ->orWhere('away_second_player_id', $request->player_id);
            });
        }

        if ($request->competition_id) {
            $dataContent = $dataContent->where('competition_id', $request->competition_id);
        }
        if ($request->round_category_id) {
            $dataContent = $dataContent->where('round_category_id', $request->round_category_id);
        }
        if ($request->player_category_code) {
            $dataContent = $dataContent->where('player_category_code', $request->player_category_code);
        }

        if ($request->match_type_category_id) {
            $dataContent = $dataContent->where('match_type_category_id', $request->match_type_category_id);
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

        $match_detail_req = $request->match_detail;
        $match_detail_req['match_id'] = $data['id'];

        $match_detail = MatchDetail::whereMatchId($id)->first();

        if ($match_detail) {
            $match_detail->update($match_detail_req);
        } else {
            MatchDetail::create($match_detail_req);
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

    public function searchH2H()
    {
        $match_count = MatchModel::count();
        $data = [];
        for ($i = 1; $i < $match_count; $i++) {
            $h2h = $this->headToHead($i);
            if (count($h2h) > 0) {
                $data[] = [
                    'match' => MatchModel::find($i),
                    'head2head' => $h2h,
                ];
            }
        }

        return $data;
    }

    public function headToHead($match_id)
    {
        $match_type_category_ids = [15, 16];

        $container = [];
        $match = MatchModel::whereIn('match_type_category_id', $match_type_category_ids)->find($match_id);

        if (!$match) {
            return [];
        }

        $home_first = MatchModel::where(function ($q) use ($match) {
            $q->where('home_first_player_id', $match->home_first_player_id);
            $q->orWhere('away_first_player_id', $match->home_first_player_id);
        })
            ->where('id', '!=', $match_id)
            ->whereIn('match_type_category_id', $match_type_category_ids)
            ->get();

        foreach ($home_first as $item) {
            $container[] = $item;
        }

        $away_first = MatchModel::where(function ($q) use ($match) {
            $q->where('home_first_player_id', $match->away_first_player_id);
            $q->orWhere('away_first_player_id', $match->away_first_player_id);
        })
            ->where('id', '!=', $match_id)
            ->whereNotIn('id', $home_first->pluck('id')->toArray())
            ->whereIn('match_type_category_id', $match_type_category_ids)
            ->get();

        foreach ($away_first as $item) {
            $container[] = $item;
        }

        $headtohead = [];

        foreach ($container as $cont) {
            if (
                $cont['home_first_player_id'] == $match->home_first_player_id
                &&
                $cont['away_first_player_id'] == $match->away_first_player_id
            ) {
                $headtohead[] = $cont;
            } else if (
                $cont['home_first_player_id'] == $match->home_first_player_id
                &&
                $cont['away_first_player_id'] == $match->away_first_player_id
            ) {
                $headtohead[] = $cont;
            }
        }

        return $headtohead;
    }
}
