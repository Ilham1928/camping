<?php

namespace App\Http\Responses\Web\Admin\Activity;

use App\Models\Admin\AdminActivity;
use Illuminate\Contracts\Support\Responsable;

class ActivityDeleteBulkResponse implements Responsable
{
    public function toResponse($request)
    {
        foreach($request->activity_id as $activity_id){
            AdminActivity::where('activity_id', $activity_id)->delete();
        }
        $data['code'] = 200;
        $data['message'] = 'Success';
        return response()->json($data);
    }
}
