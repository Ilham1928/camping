<?php

namespace App\Http\Responses\Web\Menu\Parent;

use App\Models\Menu\MenuParent;
use Illuminate\Contracts\Support\Responsable;

class ParentSaveResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            MenuParent::create([
                'menu_parent_name' => $request->menu_parent_name,
                'menu_icon_id' => $request->menu_icon_id,
                'status' => '1'
            ]);

            $data['code'] = 200;
            $data['message'] = 'Success';
        } catch (Exception $e) {
            $data['code'] = 500;
            $data['message'] = $e->getMessage();
        }
        return response()->json($data);
    }
}
