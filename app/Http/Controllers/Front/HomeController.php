<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\MatchModel;
use App\Models\Player;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data['page_name'] = 'home';
        $data['matches'] = MatchModel::orderByDesc('id')
            ->with([
                'competition',
                'round_category',
                'match_type',
                'home_first_player',
                'away_first_player',
                'match_detail'
            ])->limit(3)->get();

        $data['news_head'] = Post::orderByDesc('id')->first();
        $data['news'] = Post::orderByDesc('id')->skip(1)->limit(3)->get();
        $data['competitions'] = Competition::orderByDesc('date_start')->limit(5)->get();
        $data['male_players'] = Player::whereGender('M')->limit(5)->get();
        $data['female_players'] = Player::whereGender('F')->limit(5)->get();
        return view('front.home.Index', $data);
    }

    public function players()
    {
        $data['page_name'] = 'players';
        return view('front.players.Index', $data);
    }

    public function player_show($id)
    {
        $data['page_name'] = 'players';
        return view('front.players.Show', $data);
    }

    public function events()
    {
        $data['page_name'] = 'events';
        return view('front.events.Index', $data);
    }

    public function matches()
    {
        $data['page_name'] = 'matches';
        return view('front.matches.Index', $data);
    }

    public function news()
    {
        $data['page_name'] = 'news';
        return view('front.news.Index', $data);
    }

    public function admin()
    {
        return view('admin.layout');
    }

    public function auth()
    {
        return view('admin.auth');
    }

    public function test()
    {
        $this->response['message'] = "tist";
        return $this->response;
    }

    public function icons()
    {
        $files = File::allFiles(public_path('assets\media\icons\duotune'));
        //        file_get_contents($files[0]);
        return view('icons', compact('files'));
    }

    public function notFound()
    {
        return view('admin.404');
    }

    public function about()
    {
        $data['page_name'] = 'About';
        return view('front.about.Index', $data);
    }

    public function privacyPolicy()
    {
        $data['page_name'] = 'Kebijakan Privasi';
        return view('front.privacy_policy.Index', $data);
    }
}
