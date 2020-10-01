<?php

namespace App\Http\Responses\Web\Admin\Role;

use DB;
use App\Models\Admin\AdminRole;
use App\Models\Menu\MenuChild;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\AdminRolePermission;
use Illuminate\Contracts\Support\Responsable;

class RoleSaveResponse extends Controller implements Responsable
{
    public function toResponse($request)
    {
        DB::beginTransaction();
        try {
            $role = AdminRole::create([
                'role_name'        => $request->role_name,
                'role_description' => $request->role_description,
                'status'           => '1'
            ]);

            $this->activity([
                'activity_name' => 'Create New Admin Role',
                'activity_by' => Session::get('admin_name'),
                'activity_detail' => 'Create new admin role at '.date('D m, Y H:i')
            ]);

            DB::commit();
            $data['code'] = 200;
            $data['message'] = 'Success';
        } catch (Exception $e) {
            DB::rollBack();
            $data['code'] = 500;
            $data['message'] = $e->getMessage();
        }
        return response()->json($data);
    }
}
