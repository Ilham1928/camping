<?php

namespace App\Http\Responses\Web\Menu\Parent;

use App\Models\Menu\MenuParent;
use Illuminate\Contracts\Support\Responsable;

class ParentDeleteBulkResponse implements Responsable
{
    public function toResponse($request)
    {
        foreach($request->menu_parent_id as $parent_id){
            MenuParent::where('menu_parent_id', $parent_id)->update([ 'status' => '0' ]);
        }
        $data['code'] = 200;
        $data['message'] = 'Success';
        return response()->json($data, 200);
    }
}
