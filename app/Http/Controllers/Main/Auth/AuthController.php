<?php

namespace App\Http\Controllers\Main\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Responses\Web\Auth\LoginResponse;

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
            'email' => 'required|email|exists:admin_master,admin_email',
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

    public function logout()
    {
        Session::forget('admin_token');
        return redirect('/');
    }
}
