<?php

namespace App\Http\Responses\Web\Menu\Child;

use App\Models\Menu\MenuParent;
use Illuminate\Contracts\Support\Responsable;

class GetParentResponse implements Responsable
{
    public function toResponse($request)
    {
        $data = MenuParent::join('menu_icon', 'menu_icon.menu_icon_id', '=', 'menu_parent.menu_icon_id')
                        ->where('menu_parent.status','1')
                        ->get();
        try {
            if (!$data->isEmpty()) {
                return response()->json([
                    'code' => 200,
                    'data' => $data,
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
