<?php

namespace App\Http\Responses\Web\Admin\Role;

use DB;
use App\Models\Admin\AdminRole;
use App\Models\Menu\MenuChild;
use App\Models\Admin\AdminRolePermission;
use Illuminate\Contracts\Support\Responsable;

class RoleSaveResponse implements Responsable
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
