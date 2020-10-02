<?php

namespace App\Http\Responses\Web\Admin\Role;

use App\Models\Admin\AdminRole;
use Illuminate\Contracts\Support\Responsable;

class RoleDeleteBulkResponse implements Responsable
{
    public function toResponse($request)
    {
        foreach($request->role_id as $role_id){
            AdminRole::where('role_id', $role_id)->update([ 'status' => '0' ]);
        }
        $data['code'] = 200;
        $data['message'] = 'Success';
        return response()->json($data);
    }
}
