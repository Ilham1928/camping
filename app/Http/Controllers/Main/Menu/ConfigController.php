<?php

namespace App\Http\Controllers\Main\Menu;

use App\Http\Responses\Web\Menu\Config\ConfigUpdateResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu\Config;

class ConfigController extends Controller
{
    public function index(Request $request)
    {
        $id = (!empty($request->cms_config_id)) ? $request->cms_config_id : 1;
        $data['data']  = Config::where('cms_config_id', $id)->first();
        $data['title'] = 'Configuration CMS';
        return view('page.menu.config.view', $data);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cms_config_brand' => 'required',
            'cms_config_skin' => 'required|in:default,blue,green,pink,red,sea,violet',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new ConfigUpdateResponse();
    }
}
