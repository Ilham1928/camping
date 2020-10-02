<?php

namespace App\Http\Responses\Web\Admin\Master;

use App\Models\Admin\AdminMaster;
use Illuminate\Contracts\Support\Responsable;

class AdminDeleteBulkResponse implements Responsable
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
        }
    }
}
