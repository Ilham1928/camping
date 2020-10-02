<?php

namespace App\Http\Responses\Web\Item\Master;

use App\Models\Item\ItemCategory;
use Illuminate\Contracts\Support\Responsable;

class GetCategoryResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            $data = $this->data($request);

            if (!$data->isEmpty()) {
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                ], 200);
            }else{
                return response()->json([
                    'code' => 204,
                    'data' => [],
                    'message' => 'No Data',
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'data' => [],
                'message' => $e->getMessage(),
            ], 200);
        }
    }

    protected function data($request)
    {
        return ItemCategory::query()
            ->where('item_category.status', '1')
            ->get();
    }
}
