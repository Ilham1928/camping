<?php

namespace App\Http\Responses\Web\Menu\Child;

use Illuminate\Support\Str;
use App\Models\Menu\MenuChild;
use Illuminate\Contracts\Support\Responsable;

class ChildDeleteBulkResponse implements Responsable
{
    public function toResponse($request)
    {
        foreach($request->menu_child_id as $child_id){
            MenuChild::where('menu_child_id', $child_id)->update([ 'status' => '0' ]);
        }
        $data['code'] = 200;
        $data['message'] = 'Success';
        return response()->json($data, 200);
    }
}
