<?php

namespace App\Http\Responses\Web\Menu\Icon;

use App\Models\Menu\Icon;
use Illuminate\Contracts\Support\Responsable;

class IconDeleteResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            Icon::where('menu_icon_id', $request->menu_icon_id)->update([ 'status' => '0' ]);
            $data['code'] = 200;
            $data['message'] = 'Success';
        } catch (\Exception $e) {
            $data['code'] = 500;
            $data['message'] = $e->getMessage();
        }
        return response()->json($data, 200);
    }
}
