<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MatchModel;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index(Request $request)
    {
        $query['month'] = $request->month ?? date('m');
        $query['year'] = $request->year ?? date('Y');

        $matches = MatchModel::whereYear('date', $query['year'])
            ->whereMonth('date', $query['month'])
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

    public function matchPlayer(Request $request)
    {
        $query['year'] = $request->year ?? date('Y');

        $matches = MatchModel::whereYear('date', $query['year'])
            ->where(function ($q) use ($request) {
                $q->where('home_first_player_id', $request->player_id)
                    ->orWhere('home_second_player_id', $request->player_id)
                    ->orWhere('away_first_player_id', $request->player_id)
                    ->orWhere('away_second_player_id', $request->player_id);
            })->get();

        return $matches;
    }
}
