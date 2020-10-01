<?php

namespace App\Http\Responses\Web\Item\Category;

use App\Models\Item\ItemCategory;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Responsable;

class ItemCategorySaveResponse extends Controller implements Responsable
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

        $this->activity([
            'activity_name' => 'Create New Category Item',
            'activity_by' => Session::get('admin_name'),
            'activity_detail' => 'Create new category item at '.date('D m, Y H:i')
        ]);
    }
}
