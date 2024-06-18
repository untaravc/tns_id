<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\Player;
use App\Models\Point;
use App\Models\MatchModel;
use App\Services\UploadFileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $data['competitions_count'] = Competition::count();
        $data['points_count'] = Point::whereStatus(1)->count();
        $data['matches_count'] = MatchModel::whereStatus(1)->count();

        $this->response['result'] = $data;
        return $this->response;
    }

    public function upload(Request $request, UploadFileService $uploadService)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->first();
        }

        $file_name = $uploadService->fileUploadProcessing($request, 'players');

        $this->response['result'] = env('APP_URL') . '/storage/' . $file_name;
        return $this->response;
    }

    public function test(Request $request, UploadFileService $uploadService)
    {
        return $uploadService->fileUploadProcessing($request, 'players');
    }
}
