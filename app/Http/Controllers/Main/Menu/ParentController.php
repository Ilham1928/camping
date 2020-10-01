<?php

namespace App\Http\Controllers\Main\Menu;

use App\Http\Responses\Web\Menu\Parent\ParentResponse;
use App\Http\Responses\Web\Menu\Parent\GetIconResponse;
use App\Http\Responses\Web\Menu\Parent\ParentSaveResponse;
use App\Http\Responses\Web\Menu\Parent\ParentUpdateResponse;
use App\Http\Responses\Web\Menu\Parent\ParentDeleteResponse;
use App\Http\Responses\Web\Menu\Parent\ParentDeleteBulkResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\Menu\MenuParent;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function getData()
    {
        return new ParentResponse;
    }

    public function index()
    {
        $data['title']  = 'Manage Menu Parent';
        return view('page.menu.parent.view', $data);
    }

    public function add()
    {
        $data['title'] = 'Add New Menu Parent';
        return view('page.menu.parent.add', $data);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_parent_name' => 'required|unique:menu_parent,menu_parent_name',
            'menu_icon_id' => 'required|exists:menu_icon,menu_icon_id',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new ParentSaveResponse();
    }

    public function edit($id, Request $request)
    {
        $data['data']  = MenuParent::where('menu_parent_id', $id)->first();
        $data['title'] = 'Edit Data Menu Parent';
        return view('page.menu.parent.edit', $data);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_parent_name' => [
                'required', Rule::unique('menu_parent', 'menu_parent_name')->where(function ($query) use($request){
                    return $query->where('menu_parent_id', '!=', $request->menu_parent_id);
                })
            ],
            'menu_icon_id' => 'required|exists:menu_icon,menu_icon_id',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new ParentUpdateResponse();
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_parent_id.*' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new ParentDeleteResponse;
    }

    public function bulkDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_parent_id.*' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new ParentDeleteBulkResponse;
    }

    public function getIcon(Request $request)
    {
        return new GetIconResponse;
    }
}
