<?php

namespace App\Http\Controllers\Main\Menu;

use App\Http\Responses\Web\Menu\Icon\IconResponse;
use App\Http\Responses\Web\Menu\Icon\IconSaveResponse;
use App\Http\Responses\Web\Menu\Icon\IconUpdateResponse;
use App\Http\Responses\Web\Menu\Icon\IconDeleteResponse;
use App\Http\Responses\Web\Menu\Icon\IconDeleteBulkResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Menu\Icon;

class IconController extends Controller
{
    public function getData(Request $request)
    {
        return new IconResponse;
    }

    public function index(Request $request)
    {
        $data['title']  = 'Manage Icon';
        return view('page.menu.icon.view', $data);
    }

    public function add()
    {
        $data['title'] = 'Add New Icon';
        return view('page.menu.icon.add', $data);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_icon_name' => 'required|unique:menu_icon,menu_icon_name',
            'menu_icon_class' => 'required|unique:menu_icon,menu_icon_class',
            'menu_icon_brand' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new IconSaveResponse();
    }

    public function edit($id, Request $request)
    {
        $data['data']  = Icon::where('menu_icon_id', $id)->first();
        $data['title'] = 'Edit Data Icon';
        return view('page.menu.icon.edit', $data);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_icon_name' => [
                'required', Rule::unique('menu_icon', 'menu_icon_name')->where(function ($query) use($request){
                    return $query->where('menu_icon_id', '!=', $request->menu_icon_id);
                })
            ],
            'menu_icon_class' => [
                'required', Rule::unique('menu_icon', 'menu_icon_class')->where(function ($query) use($request){
                    return $query->where('menu_icon_id', '!=', $request->menu_icon_id);
                })
            ],
            'menu_icon_brand' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new IconUpdateResponse();
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_icon_id' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        return new IconDeleteResponse;
    }

    public function bulkDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_icon_id.*' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new IconDeleteBulkResponse;
    }
}
