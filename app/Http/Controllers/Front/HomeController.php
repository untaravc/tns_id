<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('front.home.Index');
    }

    public function players(){
        return view('front.players.Index');
    }

    public function player_show($id){
        return view('front.players.Show');
    }
}
