<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MatchModel;
use App\Models\Player;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index(Request $request)
    {
        $query['month'] = $request->month ?? date('m');
        $query['year'] = $request->year ?? date('Y');

        $matches = MatchModel::whereYear('date', $query['year'])
            ->whereMonth('date', $query['month'])
            ->with('player_category', 'round_category', 'home_first_player', 'away_first_player', 'match_detail')
            ->get();

        $match_types = Category::where('type', 'match_type')
            ->get();

        foreach ($match_types as $match_type) {
            $own_matches = $matches->where('match_type_category_id', $match_type->id)->flatten();
            $match_type->setAttribute('matches', $own_matches);
        }

        $data['match_types'] = $match_types;
        if($request->json == 1){
            return $data;
        }
        $data['page_name'] = 'matches';
        return view('front.matches.Index', $data);
    }

    public function matchPlayer(Request $request, $player_id)
    {
        $query['year'] = $request->year ?? date('Y');

        $matches = MatchModel::whereYear('date', $query['year'])
            ->where(function ($q) use ($player_id) {
                $q->where('home_first_player_id', $player_id)
                    ->orWhere('home_second_player_id', $player_id)
                    ->orWhere('away_first_player_id', $player_id)
                    ->orWhere('away_second_player_id', $player_id);
            })->get();

        $data['matches'] = $matches;
        $data['player'] = Player::find($player_id);

        return view('front.matches.Player', $data);
    }
}
