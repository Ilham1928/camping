<?php

namespace App\Http\Responses\Web\Auth;

use \Firebase\JWT\JWT;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Support\Responsable;

class RegisterResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            $this->createData($request);

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

    protected function createData($request)
    {
        User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_card' => $request->id_card,
            'address' => $request->address,
            'role_id' => 1000
        ]);
    }
}
