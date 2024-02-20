<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserWebToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function App\Http\Controllers\Admin\client_id;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $auth = $request->user();
        $min_role = $auth['role_id'];

        $dataContent = User::orderByDesc('created_at')
            ->where('role_id', '>=', $min_role)
            ->when($auth['client_id'] > 0, function ($q) use ($auth){
                $q->whereClientId($auth['client_id']);
            })
            ->with(['stations', 'client'])
            ->leftJoin('roles', 'roles.id', 'users.role_id')
            ->select('users.*', 'roles.name as role');
        $dataContent = $this->withFilter($dataContent, $request);
        $dataContent = $dataContent->paginate($request->per_page ?? 20);

        $result = collect($this->response);
        return $result->merge($dataContent);
    }

    public function withFilter($dataContent, $request)
    {
        if ($request->name) {
            $dataContent = $dataContent->where('users.name', 'LIKE', '%' . $request->name . '%');
        }
        return $dataContent;
    }

    public function store(Request $request)
    {
        $auth = $request->user();
        $request->merge([
            'client_id' => $auth['client_id'] > 0 ? $auth['client_id'] : $request->client_id,
        ]);
        $this->validateData($request);
        $request->merge([
            'password'  => Hash::make($request->password),
        ]);


        User::create($request->all());

        return $this->response;
    }

    public function validateData($request)
    {
        if ($request->id) {
            // Update
            $validator = Validator::make($request->all(), [
                'name'     => 'required',
                'email'    => 'required|email|unique:users,id,' . $request->id,
                'password' => 'nullable',
                'role_id'  => 'required',
                'pin_key'  => 'nullable|confirmed|digits:4',
            ], [
                "pin_key.unique" => "Kode PIN telah digunakan oleh orang lain",
                "pin_key.min"    => "Kode PIN harus 4 digit",
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name'     => 'required',
                'email'    => 'required|unique:users|email',
                'password' => 'required|confirmed',
                'pin_key'  => 'required|confirmed|digits:4',
                'role_id'  => 'required',
            ], [
                "pin_key.min" => "Kode PIN harus 4 digit",
            ]);
        }

        if ($validator->fails()) {
            $this->response['errors'] = $validator->errors();
            abort(response($this->response, 422));
        }

        if($request->pin_key){
            $used = User::whereClientId($request->client_id)
                ->where('pin_key', $request->pin_key)
                ->first();
            if($used){
                $this->response['errors'] = [
                    'pin_key' => ['Kode PIN telah digunakan']
                ];
                abort(response($this->response, 422));
            }
        }
    }

    public function update(Request $request, $id)
    {
        $auth = $request->user();
        $request->merge([
            'client_id' => $auth['client_id'] > 0 ? $auth['client_id'] : $request->client_id,
            'id' => $id
        ]);

        $this->validateData($request);

        $user = User::find($request->id);
        if ($user) {
            $user->update([
                'client_id' => $auth['client_id'] > 0 ? $auth['client_id'] : $request->client_id,
                'name'      => $request->name,
                'email'     => $request->email,
                'status'    => $request->status,
            ]);

            if ($request->pin_key) {
                $user->update([
                    'pin_key' => $request->pin_key,
                ]);
            }

            if ($request->password) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            $this->response['message'] = 'Updated!';
        } else {
            $this->response['success'] = false;
            $this->response['message'] = 'No User';
        }

        return $this->response;
    }

    public function show($id)
    {
        $user = User::find($id);

        $this->response['result'] = $user;
        return $this->response;
    }

    public function destroy($id)
    {
        $auth = Auth::guard()->user();
        $user = User::where('id', '!=', 1)->find($id);

        if ($user && in_array($auth['role_id'], [1, 2])) {
            $user->delete();
        }
        return $this->response;
    }

    public function list(Request $request)
    {
        $this->response['result'] = User::orderBy('name')
            ->whereClientId(client_id($request))
            ->get();

        return $this->response;
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $user->update([
            "name"  => $request->name,
            "email" => $request->email,
        ]);

        if ($request->pin_key) {
            $user->update([
                "pin_key" => $request->pin_key,
            ]);
        }

        if ($request->password) {
            $user->update([
                "password" => Hash::make($request->password),
            ]);
        }

        return $this->response;
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        $this->response['result'] = $user;
        return $this->response;
    }

    public function checkPin(Request $request)
    {
        $user = User::wherePinKey($request->pin_key)->first();
        if (!$user) {
            $this->response['success'] = false;
            return $this->response;
        }

        $this->response['result'] = $user;
        return $this->response;
    }

    public function setFcmToken(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return $this->response;
        }

        $user_web_token = UserWebToken::whereUserId($user->id)
            ->whereToken($request->token)
            ->first();

        if (!$user_web_token) {
            UserWebToken::create([
                "user_id" => $user['id'],
                "token"   => $request->token,
                "status"  => 1
            ]);
        } else {
            $user_web_token->update([
                "status"     => 1,
                "updated_at" => now()
            ]);
        }

        // update inactive token
        return $this->response;
    }
}
