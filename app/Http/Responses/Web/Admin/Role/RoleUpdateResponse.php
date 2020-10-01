<?php

namespace App\Http\Responses\Web\Admin\Role;

use App\Models\Admin\AdminRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Responsable;

class RoleUpdateResponse extends Controller implements Responsable
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

            $this->activity([
                'activity_name' => 'Update Data Admin Role'. $request->role_name,
                'activity_by' => Session::get('admin_name'),
                'activity_detail' => 'Update data admin role at '.date('D m, Y H:i')
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
