<?php

namespace App\Http\Responses\Web\Menu\Icon;

use App\Models\Menu\Icon;
use Illuminate\Contracts\Support\Responsable;

class IconSaveResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            Icon::create([
                'menu_icon_name' => $request->menu_icon_name,
                'menu_icon_class' => $request->menu_icon_class,
                'menu_icon_brand' => $request->menu_icon_brand,
                'menu_icon_unicode' => $request->menu_icon_unicode,
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
