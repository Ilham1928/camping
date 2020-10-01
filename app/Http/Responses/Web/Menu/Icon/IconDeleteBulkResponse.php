<?php

namespace App\Http\Responses\Web\Menu\Icon;

use App\Models\Menu\Icon;
use Illuminate\Contracts\Support\Responsable;

class IconDeleteBulkResponse implements Responsable
{
    public function toResponse($request)
    {
        foreach($request->menu_icon_id as $icon_id){
            Icon::where('menu_icon_id', $icon_id)->update([ 'status' => '0' ]);
        }
        $data['code'] = 200;
        $data['message'] = 'Success';
        return response()->json($data, 200);
    }
}
