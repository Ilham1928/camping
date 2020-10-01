<?php

namespace App\Http\Responses\Web\Admin\Activity;

use App\Models\Admin\AdminActivity;
use Illuminate\Contracts\Support\Responsable;

class ActivityDeleteResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            AdminActivity::where('activity_id', $request->activity_id)->delete();
            $data['code'] = 200;
            $data['message'] = 'Success';
        } catch (\Exception $e) {
            $data['code'] = 500;
            $data['message'] = $e->getMessage();
        }
        return response()->json($data, 200);
    }
}
