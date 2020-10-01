<?php

namespace App\Http\Responses\Web\Item\Category;

use App\Models\Item\ItemCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Responsable;

class ItemCategoryDeleteResponse extends Controller implements Responsable
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
        ItemCategory::where('category_id', $request->category_id)->update([ 'status' => '0' ]);

        $this->activity([
            'activity_name' => 'Delete Data Category With ID: '. $request->category_id,
            'activity_by' => Session::get('admin_name'),
            'activity_detail' => 'Delete data category at '.date('D m, Y H:i')
        ]);
    }
}
