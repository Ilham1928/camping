<?php

namespace App\Http\Responses\Web\Menu\Config;

use App\Models\Menu\Config;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Session;

class ConfigUpdateResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            Config::where('cms_config_id', $request->cms_config_id)
                ->update([
                    'cms_config_brand' => $request->cms_config_brand,
                    'cms_config_skin' => $request->cms_config_skin,
                ]);

            $data['code'] = 200;
            $data['message'] = 'Success';

            Session::forget(['brand', 'skin']);
        } catch (Exception $e) {
            $data['code'] = 500;
            $data['message'] = $e->getMessage();
        }
        return response()->json($data);
    }
}
