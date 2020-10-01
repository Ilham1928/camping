<?php

namespace App\Http\Controllers\Main\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Responses\Web\Auth\LoginResponse;
use App\Http\Responses\Web\Auth\RegisterResponse;

class AuthController extends Controller
{
    public function index()
    {
        $data['title'] = 'Login Admin';
        return view('page.auth.login', $data);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        return new LoginResponse;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:3',
            'id_card' => 'required|numeric|digits:16|unique:user,id_card',
            'email' => 'required|email|unique:user,id_card',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'address' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        return new RegisterResponse;
    }

    public function logout()
    {
        Session::forget('admin_token');
        return redirect('/');
    }
}
