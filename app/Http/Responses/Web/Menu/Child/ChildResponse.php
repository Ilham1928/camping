<?php

namespace App\Http\Responses\Web\Menu\Child;

use Illuminate\Support\Str;
use App\Models\Menu\MenuChild;
use Illuminate\Contracts\Support\Responsable;

class ChildResponse implements Responsable
{
    public function toResponse($request)
    {
        $data = MenuChild::join('menu_parent', 'menu_parent.menu_parent_id', '=', 'menu_child.menu_parent_id')
                        ->where('menu_child.status','1')
                        ->paginate(10);
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
                    'data' => [],
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
