<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'client_id' => $request->client_id,
        ]);

        //return response JSON user is created
        if ($user) {
            return response()->json([
                'success' => true,
                'user'    => $user,
            ], 201);
        }

        //return JSON process insert failed
        return response()->json([
            'success' => false,
        ], 409);
    }

    public function login(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'email'    => 'required',
            'password' => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //get credentials from request
        $credentials = $request->only('email', 'password');

        //Create token
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Could not create token.',
            ], 500);
        }

        //Token created, return with success response and jwt token
        $this->response['result'] = [
            'user'    => auth()->guard('api')->user(),
            'token'   => $token
        ];

        return $this->response;
    }

    public function auth(Request $request)
    {
        $user = $request->user();

        $result = User::with(['role'])->find($user['id']);

        $this->response['result'] = $result;
        return $this->response;
    }

    public function menu(Request $request)
    {
        $user = $request->user();

        $role_id = $user['role_id'];
        $menu_ids = MenuRole::whereRoleId($role_id)->pluck('menu_id');

        $menus = Menu::whereIn('id', $menu_ids)
            ->orderBy('order')
            ->get()->toArray();

        $menu_ctrl = new MenuController();
        $menu_tree = $menu_ctrl->buildTree($menus);

        $this->response['result'] = $menu_tree;
        return $this->response;
    }
}
