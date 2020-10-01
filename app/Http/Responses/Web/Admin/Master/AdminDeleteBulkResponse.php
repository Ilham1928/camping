<?php

namespace App\Http\Responses\Web\Admin\Master;

use App\Models\Admin\AdminMaster;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Responsable;

class AdminDeleteBulkResponse extends Controller implements Responsable
{
    public function toResponse($request)
    {
        try {
            $this->delete($request);

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => new \stdClass
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
                'data' => new \stdClass
            ], 200);
        }
    }

    protected function delete($request)
    {
        foreach($request->admin_id as $admin_id){
            AdminMaster::where('admin_id', $admin_id)->update([ 'status' => '0' ]);

            $this->activity([
                'activity_name' => 'Delete Data Admin With ID: '. $admin_id,
                'activity_by' => Session::get('admin_name'),
                'activity_detail' => 'Delete data admin at '.date('D m, Y H:i')
            ]);
        }
    }
}
