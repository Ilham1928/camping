<?php

namespace App\Http\Responses\Web\Item\Category;

use App\Models\Item\ItemCategory;
use Illuminate\Contracts\Support\Responsable;

class ItemCategorySaveResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            $this->create($request);

            return response()->json([
                'code' => 200,
                'messsage' => 'Success',
                'data' => new \stdClass
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
                'data' => new \stdClass
            ], 200);
        }
    }

    protected function create($request)
    {
        ItemCategory::create([
            'category_name' => $request->category_name,
            'status' => '1',
        ]);
    }
}
