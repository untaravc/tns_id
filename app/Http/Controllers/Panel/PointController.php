<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\MatchModel;
use App\Models\MatchPointSetting;
use App\Models\Player;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PointController extends Controller
{
    public $point_created = 0;
    public $point_updated = 0;

    public function index(Request $request)
    {
        $dataContent = Point::orderByDesc('created_at')
            ->with(['match' => function ($q) {
                $q->with(['round_category', 'competition', 'match_type']);
            }]);
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
            'player_gender'    => $player->gender,
            'competition_id'   => $request->competition_id ?? 0,
            'competition_name' => $competition ? $competition->name : '',
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
            $dataContent = $dataContent->where('player_name', 'LIKE', '%' . $request->name . '%');
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
            'player_gender'    => $player->gender,
            'competition_name' => $competition->name ?? '',
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
            ->when($request->name, function($q)use($request){
                $q->where('player_name', 'LIKE', '%'.$request->name.'%');
            })
            ->when($request->year, function($q)use($request){
                $q->whereYear('date', $request->year);
            })
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

    public function updatePlayerPoints()
    {
        $matches = MatchModel::with(['competition', 'match_type', 'round_category'])
            ->get();

        foreach ($matches as $match) {
            try {
                $this->setPlayerPoint($match);
            } catch (\Exception $e) {
                return [
                    'message' => "GAGAL: match_id " . $match->id,
                    'errors' => $e,
                    'match' => $match
                ];
            }
        }
        return [
            'match' => count($matches),
            'update' => $this->point_updated,
            'created' => $this->point_created,
        ];
    }

    private function setPlayerPoint($match)
    {
        $query['competition_code'] = $match->competition->competition_category_code;
        $query['match_type_code'] = substr($match->match_type->code, 0, 1);
        $query['round_code'] = $match->round_category->code;

        $match_point_settings = MatchPointSetting::where('competition_code', $query['competition_code'])
            ->where('match_type_code', $query['match_type_code'])
            ->get();

        // return $match;
        if ($match->home_final_score > $match->away_final_score) {
            $player['win_first'] = $match->home_first_player_id;
            $player['win_second'] = $match->home_second_player_id;
            $player['lose_first'] = $match->away_first_player_id;
            $player['lose_second'] = $match->away_second_player_id;
        } else {
            $player['win_first'] = $match->away_first_player_id;
            $player['win_second'] = $match->away_second_player_id;
            $player['lose_first'] = $match->home_first_player_id;
            $player['lose_second'] = $match->home_second_player_id;
        }

        // Final -> yg menang W, yg kalah F
        if ($query['round_code'] == 'F') {
            $win = $match_point_settings->where('round_code', 'W')->first();
            if ($win) {
                $this->generatePlayerPoint($player['win_first'], $win, $match);
                if ($player['win_second']) {
                    $this->generatePlayerPoint($player['win_second'], $win, $match);
                }
            }

            $final = $match_point_settings->where('round_code', 'F')->first();
            if ($final) {
                $this->generatePlayerPoint($player['lose_first'], $final, $match);
                if ($player['lose_second']) {
                    $this->generatePlayerPoint($player['lose_second'], $final, $match);
                }
            }
        }

        // SF -> yg kalah SF
        if ($query['round_code'] == 'SF') {
            $semifinal = $match_point_settings->where('round_code', 'SF')->first();
            if ($semifinal) {
                $this->generatePlayerPoint($player['lose_first'], $semifinal, $match);
                if ($player['lose_second']) {
                    $this->generatePlayerPoint($player['lose_second'], $semifinal, $match);
                }
            }
        }

        // QF -> yg kalah QF
        if ($query['round_code'] == 'QF') {
            $quarterfinal = $match_point_settings->where('round_code', 'QF')->first();
            if ($quarterfinal) {
                $this->generatePlayerPoint($player['lose_first'], $quarterfinal, $match);
                if ($player['lose_second']) {
                    $this->generatePlayerPoint($player['lose_second'], $quarterfinal, $match);
                }
            }
        }

        // R16 -> yg kalah R16
        if ($query['round_code'] == 'R16') {
            $roundsixteen = $match_point_settings->where('round_code', 'R16')->first();
            if ($roundsixteen) {
                $this->generatePlayerPoint($player['lose_first'], $roundsixteen, $match);
                if ($player['lose_second']) {
                    $this->generatePlayerPoint($player['lose_second'], $roundsixteen, $match);
                }
            }
        }

        // R32 -> yg kalah R32
        if ($query['round_code'] == 'R32') {
            $roundthrty = $match_point_settings->where('round_code', 'R32')->first();
            if ($roundthrty) {
                $this->generatePlayerPoint($player['lose_first'], $roundthrty, $match);
                if ($player['lose_second']) {
                    $this->generatePlayerPoint($player['lose_second'], $roundthrty, $match);
                }
            }
        }

        // R62 -> yg kalah R64
        if ($query['round_code'] == 'R64') {
            return $roundsixty = $match_point_settings->where('round_code', 'R64')->first();
            if ($roundthrty) {
                $this->generatePlayerPoint($player['lose_first'], $roundsixty, $match);
                if ($player['lose_second']) {
                    $this->generatePlayerPoint($player['lose_second'], $roundsixty, $match);
                }
            }
        }

        return $query;
    }

    private function generatePlayerPoint($player_id, $point, $match)
    {
        if (!$point) {
            return 'no data point';
        }
        $player = Player::find($player_id);
        $payload = [
            "match_id"                => $match->id,
            "match_type"              => $match->match_type->code,
            "player_id"               => $player_id,
            "player_name"             => $player->full_name,
            "player_reg_id"           => $player->reg_id,
            "competition_id"          => $match->competition_id,
            "competition_name"        => $match->competition_name,
            "player_category_code"    => $match->player_category_code,
            "point"                   => $point->point,
            "is_cut_off"              => 0,
            "is_historical"           => 0,
            "user_id"                 => 0,
            "date"                    => $match->date,
            "status"                  => 1,
            "player_gender"           => $player->gender,
        ];

        $point = Point::where('match_id', $payload['match_id'])
            ->where('player_id', $payload['player_id'])
            ->first();

        if ($point) {
            $point->update($payload);
            $this->point_updated += 1;
        } else {
            Point::create($payload);
            $this->point_created += 1;
        }
    }
}
