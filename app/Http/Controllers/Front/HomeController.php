<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index(){
        $data['page_name'] = 'home';
        return view('front.home.Index', $data);
    }

    public function players(){
        $data['page_name'] = 'players';
        return view('front.players.Index', $data);
    }

    public function player_show($id){
        $data['page_name'] = 'players';
        return view('front.players.Show', $data);
    }

    public function events(){
        $data['page_name'] = 'events';
        return view('front.events.Index', $data);
    }

    public function matches(){
        $data['page_name'] = 'matches';
        return view('front.matches.Index', $data);
    }

    public function news(){
        $data['page_name'] = 'news';
        return view('front.news.Index', $data);
    }

    public function admin(){
        return view('admin.layout');
    }

    public function auth(){
        return view('admin.auth');
    }

    public function test(){
        $this->response['message'] = "tist";
        return $this->response;
    }

    public function icons(){
        $files = File::allFiles(public_path('assets\media\icons\duotune'));
//        file_get_contents($files[0]);
        return view('icons', compact('files'));
    }

    public function notFound(){
        return view('admin.404');
    }
}
