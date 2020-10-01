<?php

namespace App\Http\Responses\Web\Menu\Child;

use Illuminate\Support\Str;
use App\Models\Menu\MenuChild;
use Illuminate\Contracts\Support\Responsable;

class ChildUpdateResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            MenuChild::where('menu_child_id', $request->menu_child_id)
                    ->update([
                        'menu_child_name' => $request->menu_child_name,
                        'menu_child_url' => Str::slug($request->menu_child_url, '-'),
                        'menu_parent_id' => $request->menu_parent_id,
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
