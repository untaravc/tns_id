<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Competition;
use App\Models\MatchModel;
use App\Models\Player;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data['page_name'] = 'home';
        $data['matches'] = MatchModel::orderByDesc('date')
            ->with([
                'competition',
                'round_category',
                'match_type',
                'home_first_player',
                'home_second_player',
                'away_first_player',
                'away_second_player',
                'match_detail'
            ])->limit(3)->get();

        $cat_news = Category::whereIn('code', ['news'])->pluck('id')->toArray();
        $data['news_head'] = Post::orderByDesc('id')->with('resource')->whereIn('category_id', $cat_news)->first();
        $data['news'] = Post::orderByDesc('id')->with('resource')->whereIn('category_id', $cat_news)->skip(1)->limit(3)->get();
        $data['competitions'] = Competition::orderByDesc('date_start')->where('status', 1)->limit(5)->get();
        $data['male_players'] = Player::whereGender('M')->where('player_category_code', '!=', null)->inRandomOrder()->limit(5)->get();
        $data['female_players'] = Player::whereGender('F')->where('player_category_code', '!=', null)->inRandomOrder()->limit(5)->get();
        $data['socmed'] = Setting::whereType('website')->get();

        $ads = Setting::whereName('ads_home_footer')->whereStatus(1)->first();
        if ($ads) {
            $data['ads'] = Post::where('image_desc', $ads->name)
                ->whereStatus(1)
                ->inRandomOrder()
                ->get();
        }

        foreach ($data['male_players'] as $key => $player) {
            $player->setAttribute('image', '/assets/images/male' . ($key % 2) . '-t.png');
        }

        foreach ($data['female_players'] as $key => $player) {
            $player->setAttribute('image', '/assets/images/female' . ($key % 2) . '-t.png');
        }

        foreach ($data['competitions'] as $key => $competition) {
            if ($competition->image == null) {
                $competition->setAttribute('image', '/assets/images/competition' . ($key % 3) . '.jpeg');
            }
        }

        return view('front.home.Index', $data);
    }

    public function players(Request $request)
    {
        $data['page_name'] = 'players';
        $data['page_bg'] = '/assets/images/players.png';

        $query['gender'] = $request->gender ?? 'M';
        $query['player_category_code'] = $request->player_category_code ?? 'U10';

        $data['player_categories'] = Category::where('type', 'player')->get();
        $data['socmed'] = Setting::whereType('website')->get();

        $data['players'] = Player::when($query['gender'], function ($q) use ($query) {
            $q->where('gender', $query['gender']);
        })->when($query['player_category_code'], function ($q) use ($query) {
            $q->where('player_category_code', $query['player_category_code']);
        })->orderBy('full_name')->get();

        foreach ($data['players'] as $key => $player) {
            if ($player->gender == 'M') {
                $player->setAttribute('image', '/assets/images/male' . ($key % 2) . '-t.png');
            } else {
                $player->setAttribute('image', '/assets/images/female' . ($key % 2) . '-t.png');
            }
        }

        if ($request->json == 1) {
            return $data;
        }

        return view('front.players.Index', $data);
    }

    public function player_show($id)
    {
        $data['page_name'] = 'players';
        return view('front.players.Show', $data);
    }

    public function competitions(Request $request)
    {
        $data['page_name'] = 'competitions';
        $data['socmed'] = Setting::whereType('website')->get();
        $data['competitions'] = Competition::orderBy('date_start')->whereStatus(1)->get();
        foreach ($data['competitions'] as $key => $competition) {
            if ($competition->image == null) {
                $competition->setAttribute('image', '/assets/images/competition' . ($key % 3) . '.jpeg');
            }
        }
        if ($request->json == 1) {
            return $data;
        }
        return view('front.competitions.Index', $data);
    }

    public function competitionsShow($id, Request $request)
    {
        $id = explode('-', $id)[0];

        $data['competition'] = Competition::find($id);
        $data['socmed'] = Setting::whereType('website')->get();

        $matches = MatchModel::whereCompetitionId($id)
            ->get();

        $match_type_ids = $matches->unique('match_type_category_id')->pluck('match_type_category_id')->toArray();
        $data['match_type'] = Category::whereType('match_type')
            ->whereIn('id', $match_type_ids)
            ->get();

        $query['match_type_category_id'] = $request->match_type_category_id ?? ($match_type_ids[0] ?? null);

        $player_category_codes = $matches->unique('player_category_code')->pluck('player_category_code')->toArray();

        $data['player_categories'] = Category::whereIn('code', $player_category_codes)
            ->get();

        $query['player_category_code'] = $request->player_category_code ?? ($player_category_codes[0] ?? null);

        $round_ids = $matches->unique('round_category_id')->pluck('round_category_id')->toArray();

        $data['rounds'] = Category::whereType('round')
            ->whereIn('id', $round_ids)
            ->orderByRaw("FIELD(code , 'F', 'SF', 'QF','R3','R2','R1') ASC")
            ->get();

        $data['page_name'] = $data['competition']['name'];

        $filtered_matches =  $matches->where('player_category_code', $query['player_category_code'])
            ->where('match_type_category_id', $query['match_type_category_id']);

        $data['match_count'] = 0;
        foreach ($data['rounds'] as $round) {
            $match_data = $filtered_matches->where('round_category_id', $round['id'])->flatten();
            $round->setAttribute('matches', $match_data);
            $data['match_count'] += count($match_data);
        }

        if ($request->json == 1) {
            return $data;
        }

        return view('front.competition_detail.Index', $data);
    }

    public function news()
    {
        $data['page_name'] = 'news';
        $data['page_bg'] = '/assets/images/news.png';
        $data['posts'] = Post::orderByDesc('created_at')->get();
        $data['socmed'] = Setting::whereType('website')->get();
        return view('front.posts.Index', $data);
    }

    public function postShow($id)
    {
        $id = explode('-', $id)[0];

        $data['post'] = Post::find($id);
        $data['socmed'] = Setting::whereType('website')->get();
        $ads = Setting::whereName('ads_space_side_detail')->whereStatus(1)->first();
        if ($ads) {
            $data['ads'] = Post::where('image_desc', $ads->name)
                ->whereStatus(1)
                ->inRandomOrder()
                ->get();
        }

        $data['posts'] = Post::where('id', '!=', $id)->orderByDesc('created_at')
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
