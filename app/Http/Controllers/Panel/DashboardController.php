<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\Player;
use App\Models\Point;
use App\Models\Match;
use App\Models\MatchModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.Layout');
    }

    public function dashboardStats()
    {
        $data = [];
        $data['players_count'] = Player::whereStatus(1)->count();
        $data['competitions_count'] = Competition::whereStatus(1)->count();
        $data['points_count'] = Point::whereStatus(1)->count();
        $data['matches_count'] = MatchModel::whereStatus(1)->count();

        $this->response['result'] = $data;
        return $this->response;
    }
}
