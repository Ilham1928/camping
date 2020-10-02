<?php

namespace App\Http\Responses\Web\Admin\Role;

use App\Models\Admin\AdminRole;
use Illuminate\Contracts\Support\Responsable;

class RoleDeleteResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            AdminRole::where('role_id', $request->role_id)->update([ 'status' => '0' ]);
            $data['code'] = 200;
            $data['message'] = 'Success';
        } catch (\Exception $e) {
            $data['code'] = 500;
            $data['message'] = $e->getMessage();
        }
        return response()->json($data, 200);
    }
}
