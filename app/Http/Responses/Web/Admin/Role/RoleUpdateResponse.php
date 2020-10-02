<?php

namespace App\Http\Responses\Web\Admin\Role;

use App\Models\Admin\AdminRole;
use Illuminate\Contracts\Support\Responsable;

class RoleUpdateResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            AdminRole::where('role_id', $request->role_id)
                ->update([
                    'role_name'        => $request->role_name,
                    'role_description' => $request->role_description,
                    'status'           => '1'
                ]);
            $data['code'] = 200;
            $data['message'] = 'Success';
        } catch (Exception $e) {
            $data['code'] = 500;
            $data['message'] = $e->getMessage();
        }
        return response()->json($data);
    }
}
