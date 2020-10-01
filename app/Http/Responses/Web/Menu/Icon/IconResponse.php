<?php

namespace App\Http\Responses\Web\Menu\Icon;

use App\Models\Menu\Icon;
use Illuminate\Contracts\Support\Responsable;

class IconResponse implements Responsable
{
    public function toResponse($request)
    {
        $data = Icon::whereStatus('1')
                    ->when(!empty($request->keyword), function($query) use($request){
                        $query->where('menu_icon_name', 'like', '%'.$request->keyword.'%')
                            ->orWhere('menu_icon_brand', '%'.$request->keyword.'%');
                    })
                    ->orderBy('menu_icon_id', 'desc')
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
                    'data' => 'No Data',
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
