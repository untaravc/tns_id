<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\MatchModel;
use App\Models\Player;
use App\Services\UploadFileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlayerController extends Controller
{
    private $uploadFileService;

    function __consturctor()
    {
        $this->uploadFileService = new UploadFileService();
    }

    public function index(Request $request)
    {
        $dataContent = Player::orderByDesc('created_at');
        $dataContent = $this->withFilter($dataContent, $request);
        $dataContent = $dataContent->paginate($request->per_page ?? 20);

        $result = collect($this->response);
        return $result->merge($dataContent);
    }

    public function list(Request $request)
    {
        $this->response['result'] = Player::orderBy('full_name')
            ->when($request->name, function ($q) use ($request) {
                $q->where('full_name', 'LIKE', '%' . $request->name . '%');
            })->when($request->gender, function ($q) use ($request) {
                $q->where('gender', $request->gender);
            })
            ->whereStatus(1)
            ->get();

        return $this->response;
    }

    public function store(Request $request)
    {
        $this->validateData($request);
        Player::create($request->all());

        return $this->response;
    }

    public function show($id)
    {
        $data = Player::find($id);

        $this->response['result'] = $data;
        return $this->response;
    }

    private function validateData($request)
    {
        if ($request->id) {
            // Update
            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'reg_id'    => 'nullable|unique:players,reg_id,' . $request->id,
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'reg_id'    => 'nullable|unique:players,reg_id',
            ]);
        }

        if ($validator->fails()) {
            $this->response['errors'] = $validator->errors();
            abort(response($this->response, 422));
        }
    }

    private function withFilter($dataContent, $request)
    {
        if ($request->name) {
            $dataContent = $dataContent->where('players.full_name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->city) {
            $dataContent = $dataContent->where('players.city', 'LIKE', '%' . $request->city . '%');
        }
        if ($request->status !== null) {
            $dataContent = $dataContent->where('players.status', $request->status);
        }
        if ($request->gender) {
            $dataContent = $dataContent->where('players.gender', $request->gender);
        }
        return $dataContent;
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'id' => $id
        ]);

        $this->validateData($request);

        $data = Player::find($request->id);
        if ($data) {
            $data->update($request->all());
            $this->response['message'] = 'Updated!';
        } else {
            $this->response['success'] = false;
            $this->response['message'] = 'No Data';
        }

        return $this->response;
    }

    public function destroy($id)
    {
        $data = Player::find($id);

        if ($data) {
            $data->delete();
        }
        return $this->response;
    }

    public function updatePlayerCategory(Request $request)
    {
        $query['year'] = $request->year ?? date('Y');
        $query['month'] = $request->month ?? date('m');
        $matches = MatchModel::whereYear('date', $query['year'])
            ->whereMonth('date', $query['month'])
            ->get();

        $players = Player::get();
        $updated = 0;
        foreach ($matches as $match) {
            $category_code = $match->player_category_code;

            if ($match->home_first_player_id) {
                $player = $players->where('id', $match->home_first_player_id)->first();
                $updated += $this->processPlayerCategory($player, $category_code);
            }
            if ($match->home_second_player_id) {
                $player = $players->where('id', $match->home_second_player_id)->first();
                $updated += $this->processPlayerCategory($player, $category_code);
            }
            if ($match->away_first_player_id) {
                $player = $players->where('id', $match->away_first_player_id)->first();
                $updated += $this->processPlayerCategory($player, $category_code);
            }
            if ($match->away_second_player_id) {
                $player = $players->where('id', $match->away_second_player_id)->first();
                $updated += $this->processPlayerCategory($player, $category_code);
            }
            // return $category_code;
        }

        return $updated . ' data updated';
    }

    private function processPlayerCategory(Player $player, $code)
    {
        $updated = 0;
        $player_code = $player->player_category_code;

        if ($player_code === null) {
            $player->update([
                'player_category_code' => $code,
            ]);
            $updated++;
        } else if ($player_code === 'U10') {
            if (!in_array($code, ['U10'])) {
                $player->update([
                    'player_category_code' => $code,
                ]);
                $updated++;
            }
        } else if ($player_code === 'U12') {
            if (!in_array($code, ['U10', 'U12'])) {
                $player->update([
                    'player_category_code' => $code,
                ]);
                $updated++;
            }
        } else if ($player_code === 'U14') {
            if (!in_array($code, ['U10', 'U12', 'U14'])) {
                $player->update([
                    'player_category_code' => $code,
                ]);
                $updated++;
            }
        } else if ($player_code === 'U16') {
            if (!in_array($code, ['U10', 'U12', 'U14', 'U16'])) {
                $player->update([
                    'player_category_code' => $code,
                ]);
                $updated++;
            }
        } else if ($player_code === 'U18') {
            if (!in_array($code, ['U10', 'U12', 'U14', 'U16', 'U18'])) {
                $player->update([
                    'player_category_code' => $code,
                ]);
                $updated++;
            }
        }

        return $updated;
    }
}
