<?php

namespace App\Http\Responses\Web\Admin\Master;

use App\Models\Admin\AdminMaster;
use Illuminate\Contracts\Support\Responsable;

class AdminResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            $data = $this->data($request);

            if (!$data->isEmpty()) {
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                    'pagination' => (string) $data->links()
                ], 200);
            }else{
                return response()->json([
                    'code' => 204,
                    'data' => new \stdClass,
                    'message' => 'No Data',
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'data' => new \stdClass,
                'message' => $e->getMessage(),
            ], 200);
        }
    }

    protected function data($request)
    {
        return AdminMaster::query()
            ->join('admin_role', 'admin_role.role_id', '=', 'admin_master.role_id')
            ->where('admin_master.status', '1')
            ->paginate(10);
    }
}
