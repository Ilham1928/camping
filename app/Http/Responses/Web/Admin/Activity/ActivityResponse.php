<?php

namespace App\Http\Responses\Web\Admin\Activity;

use App\Models\Admin\AdminActivity;
use Illuminate\Contracts\Support\Responsable;

class ActivityResponse implements Responsable
{
    public function toResponse($request)
    {
        $data = AdminActivity::paginate(10);
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
