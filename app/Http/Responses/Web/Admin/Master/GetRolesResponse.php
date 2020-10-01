<?php

namespace App\Http\Responses\Web\Admin\Master;

use App\Models\Admin\AdminRole;
use Illuminate\Contracts\Support\Responsable;

class GetRolesResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            $data = $this->data($request);

            if (!$data->isEmpty()) {
                return response()->json([
                    'code' => 200,
                    'message' => 'Success',
                    'data' => $data,
                ], 200);
            }else{
                return response()->json([
                    'code' => 204,
                    'message' => 'No Content',
                    'data' => [],
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
                'data' => new \stdClass,
            ], 200);
        }
    }

    protected function data($request)
    {
        return AdminRole::query()
            ->where('status', '1')
            ->get();
    }
}
