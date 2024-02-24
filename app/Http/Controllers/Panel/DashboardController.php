<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\Player;
use App\Models\Point;
use App\Models\MatchModel;
use App\Services\FirebaseStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    private $firebaseStorage;

    function __construct()
    {
        $this->firebaseStorage = new FirebaseStorage();
    }

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

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->first();
        }

        $imageName = time() . $request->file->getClientOriginalName();

        $response = $this->firebaseStorage->upload($imageName, $request->file);

        return $response;
    }
}
