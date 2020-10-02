<?php

namespace App\Http\Responses\Web\Item\Category;

use App\Models\Item\ItemCategory;
use Illuminate\Contracts\Support\Responsable;

class ItemCategoryDeleteBulkResponse implements Responsable
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
        foreach($request->category_id as $category_id){
            ItemCategory::where('category_id', $category_id)->update([ 'status' => '0' ]);
        }
    }
}
