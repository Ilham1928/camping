<?php

namespace App\Http\Responses\Web\Admin\Role;

use App\Models\Admin\AdminRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Responsable;

class RoleDeleteBulkResponse extends Controller implements Responsable
{
    public function toResponse($request)
    {
        foreach($request->role_id as $role_id){
            AdminRole::where('role_id', $role_id)->update([ 'status' => '0' ]);

            $this->activity([
                'activity_name' => 'Delete Data Role With ID: '. $role_id,
                'activity_by' => Session::get('admin_name'),
                'activity_detail' => 'Delete data role at '.date('D m, Y H:i')
            ]);
        }
        $data['code'] = 200;
        $data['message'] = 'Success';
        return response()->json($data);
    }
}
