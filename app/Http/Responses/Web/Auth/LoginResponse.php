<?php

namespace App\Http\Responses\Web\Auth;

use \Firebase\JWT\JWT;
use App\Models\User\User;
use App\Models\Admin\AdminMaster;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Responsable;
use App\Http\Controllers\Controller;

class LoginResponse extends Controller implements Responsable
{
    public function toResponse($request)
    {
        try {
            $admin = AdminMaster::where('status', '1')->where('admin_email', $request->email)->first();
            $user = User::where('status', '1')->where('email', $request->email)->first();

            if (!$admin && !$user) {
                return response()->json([
                    'code' => 204,
                    'message' => 'Your credential is invalid!',
                ], 200);
            }

            $password = (!$admin) ? $user->password : $admin->admin_password;
            if (!Hash::check($request->password, $password)) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Email or password is invalid!',
                ], 200);
            }

            $crendential = (!$admin) ? $user : $admin;

            $token = $this->setToken($crendential);
            if (!$admin) {
                User::where('user_id', $user->user_id)->update([
                    'token' => $token
                ]);
            }else{
                AdminMaster::where('admin_id', $admin->admin_id)->update([
                    'admin_token' => $token
                ]);
            }

            return response()->json([
                'code' => 200,
                'message' => 'Success',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ], 200);
        }
    }

    protected function setToken($request)
    {
        if (!$request->admin_id) {
            $payload = [
                'admin_id' => $request->admin_id,
                'role_id' => $request->role_id,
                'time' => date('H:i:s'),
                'date' => date('Y-m-d')
            ];
        }else{
            $payload = [
                'user_id' => $request->user_id,
                'role_id' => $request->role_id,
                'time' => date('H:i:s'),
                'date' => date('Y-m-d')
            ];
        }
        $token = JWT::encode($payload, env('JWT_SECRET'));

        if (!$request->admin_id) {
            Session::put([
                'user_id' => $request->user_id,
                'type' => 'user',
                'admin_name' => $request->fullname,
                'admin_title' => 'Pelanggan',
                'admin_photo' => $request->photo,
                'admin_role' => $request->role_id,
                'admin_token' => $token
            ]);
        }else{
            Session::put([
                'admin_id' => $request->admin_id,
                'type' => 'admin',
                'admin_name' => $request->admin_name,
                'admin_title' => $request->admin_title,
                'admin_photo' => $request->admin_photo,
                'admin_role' => $request->role_id,
                'admin_token' => $token
            ]);
        }
        return $token;
    }
}
