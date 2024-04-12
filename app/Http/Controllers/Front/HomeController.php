<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
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

    public function players(Request $request)
    {
        $data['page_name'] = 'players';
        
        $data['players'] = Player::when($request->gender, function($q) use ($request){
            $q->where('gender', $request->gender);
        })->when($request->category, function($q) use ($request){
            $q->where('player_category_code', $request->category);
        })->get();

        return view('front.players.Index', $data);
    }

    public function player_show($id)
    {
        $data['page_name'] = 'players';
        return view('front.players.Show', $data);
    }

    public function competitions()
    {
        $data['page_name'] = 'competitions';
        $data['competitions'] = Competition::orderBy('date_start')->get();
        foreach($data['competitions'] as $key => $competition){
            $competition->setAttribute('image', '/assets/images/competition' . $key . '.jpeg');
        }

        // return $data;
        return view('front.competitions.Index', $data);
    }

    public function competitionsShow($id, Request $request){
        $id = explode('-',$id)[0];

        $data['competition'] = Competition::find($id);
        $rounds = Category::whereType('round')
                ->orderByRaw("FIELD(code , 'F', 'SF', 'QF','R3','R2','R1') ASC")
                ->get();

        $data['match_type'] = Category::whereType('match_type')
                ->get();

        $data['page_name'] = $data['competition']['name'];

        foreach($data['match_type'] as $match_type){
            $match_type->setAttribute('rounds', $rounds);
        }
        
        $matches = MatchModel::whereCompetitionId($id)
            ->get();

        foreach($data['match_type'] as $type){
            foreach($type['rounds'] as $round){
                $round->setAttribute('matches', $matches->where('match_type_category_id', $type->id)
                    ->where('round_category_id', $round['id'])->flatten());
            }
        }

        if($request->json == 1){
            return $data;
        }

        return view('front.competition_detail.Index', $data);
    }

    public function matches()
    {
        $data['page_name'] = 'matches';
        return view('front.matches.Index', $data);
    }

    public function news()
    {
        $data['page_name'] = 'news';
        $data['posts'] = Post::orderByDesc('created_at')->get();
        return view('front.posts.Index', $data);
    }

    public function postShow($id){
        $id = explode('-',$id)[0];

        $data['post'] = Post::find($id);

        $data['posts'] = Post::where('id','!=', $id)->orderByDesc('created_at')
        ->limit(5)->get();
        $data['page_name'] = 'post_detail';

        return view('front.post_detail.Index', $data);

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
