<?php

namespace App\Http\Responses\Web\Admin\Permission;

use App\Models\Admin\AdminRolePermission;
use Illuminate\Contracts\Support\Responsable;

class PermissionSaveResponse implements Responsable
{
    protected $id;
    public function __construct($id)
    {
        $this->role_id = $id;
    }

    public function toResponse($request)
    {
        $param = $this->setParam($request);
        $menu_id = $this->getMenuId($request);
        $checkAvailablity = $this->checkAvailablity($menu_id);
        if ($checkAvailablity['code'] == '400') {
            return response()->json($checkAvailablity);
        }

        if ($checkAvailablity) {
            $updatePermission = $this->updatePermission($param, $menu_id);
            if ($updatePermission) {
                return $this->messageSuccess();
            }else{
                return $this->messageError();
            }
        }

        try {
            AdminRolePermission::create([
                "$param"  => '1',
                'role_id' => $this->role_id,
                'menu_id' => $menu_id
            ]);

            $data['code'] = 200;
            $data['message'] = 'Permission Success Created';
        } catch (Exception $e) {
            $data['code'] = 500;
            $data['message'] = $e->getMessage();
        }
        return response()->json($data);
    }

    public function setParam($request)
    {
        if (strpos($request->param, 'menu_view') !== false) {
            return $param = 'menu_view';
        }

        if (strpos($request->param, 'menu_add') !== false) {
            return $param = 'menu_add';
        }

        if (strpos($request->param, 'menu_edit') !== false) {
            return $param = 'menu_edit';
        }

        if (strpos($request->param, 'menu_delete') !== false) {
            return $param = 'menu_delete';
        }

        if (strpos($request->param, 'menu_other') !== false) {
            return $param = 'menu_other';
        }

        if (strpos($request->param, 'menu_view') == true) {
            return $param = 'menu_view';
        }
    }

    public function getMenuId($request)
    {
        $menu_id = explode('_', $request->param);
        return $menu_id[2];
    }

    public function checkAvailablity($value)
    {
        $checking = AdminRolePermission::where('menu_id', $value)->where('role_id', $this->role_id)->first();
        if (!$checking) {
            return false;
        }
        return true;
    }

    public function updatePermission($param, $value)
    {
        $checkForUpdate = AdminRolePermission::where('menu_id', $value)->where('role_id', $this->role_id)->where("$param", '1')->first();
        if ($checkForUpdate) {
            $update = AdminRolePermission::where('menu_id', $value)
                                        ->where('role_id', $this->role_id)
                                        ->update([
                                            "$param" => '0'
                                        ]);
        }else{
            $update = AdminRolePermission::where('menu_id', $value)
                                        ->where('role_id', $this->role_id)
                                        ->update([
                                            "$param" => '1'
                                        ]);

        }
        return $update;
    }

    public function messageSuccess()
    {
        return response()->json([
            'code' => 200,
            'message' => 'Permission Success Updated'
        ]);
    }

    public function messageError()
    {
        return response()->json([
            'code' => 200,
            'message' => 'Internal server error'
        ]);
    }
}
