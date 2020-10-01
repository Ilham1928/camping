<?php

namespace App\Http\Responses\Web\Menu\Parent;

use App\Models\Menu\MenuParent;
use Illuminate\Contracts\Support\Responsable;

class ParentDeleteResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            MenuParent::where('menu_parent_id', $request->menu_parent_id)->update([ 'status' => '0' ]);
            $data['code'] = 200;
            $data['message'] = 'Success';
        } catch (\Exception $e) {
            $data['code'] = 500;
            $data['message'] = $e->getMessage();
        }
        return response()->json($data, 200);
    }
}
