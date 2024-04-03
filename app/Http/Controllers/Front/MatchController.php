<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Competition;
use App\Models\MatchModel;
use App\Models\Player;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index(Request $request)
    {
        $match_new = MatchModel::orderByDesc('date')->first();
        $query['date'] = $request->date ?? $match_new->date;
        if ($request->act === 'next') {
            $query['date'] = date('Y-m-d', strtotime($query['date'] . '+1 day'));
        } else if ($request->act === 'prev') {
            $query['date'] = date('Y-m-d', strtotime($query['date'] . '-1 day'));
        }

        $matches = MatchModel::whereDate('date', $query['date'])
            ->with('player_category', 'round_category', 'home_first_player', 'away_first_player', 'match_detail')
            ->get();

        $match_types = Category::where('type', 'match_type')
            ->get();

        foreach ($match_types as $match_type) {
            $own_matches = $matches->where('match_type_category_id', $match_type->id)->flatten();
            $match_type->setAttribute('matches', $own_matches);
        }

        $data['match_types'] = $match_types;
        $data['query'] = $query;
        if ($request->json == 1) {
            return $data;
        }
        $data['page_name'] = 'matches';
        return view('front.matches.Index', $data);
    }

    public function matchPlayer(Request $request, $player_id)
    {
        $query['year'] = $request->year ?? date('Y');
        $player_id = explode('-', $player_id)[0];

        $matches = MatchModel::whereYear('date', $query['year'])
            ->orderByDesc('date')
            ->with('match_detail', 'match_type')
            ->where(function ($q) use ($player_id) {
                $q->where('home_first_player_id', $player_id)
                    ->orWhere('home_second_player_id', $player_id)
                    ->orWhere('away_first_player_id', $player_id)
                    ->orWhere('away_second_player_id', $player_id);
            })->get();

        $competition_ids = $matches->unique('competition_id')->pluck('competition_id')->toArray();
        $competitions = Competition::whereIn('id', $competition_ids)
            ->get();

        foreach ($competitions as $competition) {
            $competition->setAttribute('matches', $matches->where('competition_id', $competition->id)->flatten());
        }

        $data['player'] = Player::find($player_id);
        $data['competitions'] = $competitions;
        $data['page_name'] = 'match_player';

        if (count($matches) > 0) {
            $data['player']['age'] = $matches[0]['player_category_code'];
        }

        if ($request->json == 1) {
            return $data;
        }

        return view('front.match_player.Index', $data);
    }
}
