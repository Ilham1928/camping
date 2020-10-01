<?php

namespace App\Http\Responses\Web\Auth;

use \Firebase\JWT\JWT;
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
            if (!$admin) {
                return response()->json([
                    'code' => 204,
                    'message' => 'Your credential has invalid!',
                ], 200);
            }
            if (!Hash::check($request->password, $admin->admin_password)) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Email or password is invalid!',
                ], 200);
            }

            $token = $this->setToken($admin);
            AdminMaster::where('admin_id', $admin->admin_id)->update([
                'admin_token' => $token
            ]);

            $this->activity([
                'activity_name' => 'Login',
                'activity_by' => $admin->admin_name,
                'activity_detail' => 'login at: '.date('D m, Y H:i')
            ]);

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
        $payload = [
            'admin_id' => $request->admin_id,
            'role_id' => $request->role_id,
            'time' => date('H:i:s'),
            'date' => date('Y-m-d')
        ];
        $token = JWT::encode($payload, env('JWT_SECRET'));
        Session::put([
            'admin_id' => $request->admin_id,
            'admin_name' => $request->admin_name,
            'admin_title' => $request->admin_title,
            'admin_photo' => $request->admin_photo,
            'admin_token' => $token
        ]);
        return $token;
    }
}
