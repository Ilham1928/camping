<?php

namespace App\Http\Responses\Web\Admin\Permission;

use App\Models\Menu\MenuParent;
use App\Models\Admin\AdminRolePermission;
use Illuminate\Contracts\Support\Responsable;

class PermissionResponse implements Responsable
{
    public function toResponse($request)
    {
        $data['menu'] = MenuParent::where('menu_parent.status', '1')
                                    ->with(['child' => function($query){
                                        $query->where('status', '1');
                                    }])->get();
        $data['permission'] = AdminRolePermission::where('role_id', $request->role_id)->get();
        try {
            if (!$data['menu']->isEmpty()) {
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                ], 200);
            }else{
                return response()->json([
                    'code' => 204,
                    'data' => 'No Data',
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'data' => $e->getMessage(),
            ], 200);
        }
    }
}
