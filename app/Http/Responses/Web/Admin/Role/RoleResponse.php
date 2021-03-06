<?php

namespace App\Http\Responses\Web\Admin\Role;

use App\Models\Admin\AdminRole;
use Illuminate\Contracts\Support\Responsable;

class RoleResponse implements Responsable
{
    public function toResponse($request)
    {
        $data = AdminRole::where('status', '1')->paginate(10);
        try {
            if (!$data->isEmpty()) {
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                    'pagination' => (string) $data->links()
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
