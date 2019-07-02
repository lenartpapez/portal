<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use JWTAuth;

class AuthController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->input('email'))->firstOrFail();

        if ((!$token = JWTAuth::attempt($credentials))) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Vnesli ste napačne podatke.',
            ], 400);
        }

        if (!$user->hasRole(['admin', 'super_admin', 'editor'])) {
            return response([
                'status' => 'error',
                'error' => 'invalid.role',
                'msg' => 'Nimate administratorskih pravic.',
            ], 400);
        }

        return response([
            'status' => 'success',
        ])->header('Authorization', $token);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->roles = $user->roles()->pluck("name");
        return response([
            'status' => 'success',
            'data' => $user,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function refresh()
    {
        return response([
            'status' => 'success',
        ]);
    }

    public function logout()
    {
        JWTAuth::invalidate();
        return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully.',
        ], 200);
    }

}
