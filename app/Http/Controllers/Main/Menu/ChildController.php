<?php

namespace App\Http\Controllers\Main\Menu;

use App\Http\Responses\Web\Menu\Child\ChildResponse;
use App\Http\Responses\Web\Menu\Child\ChildSaveResponse;
use App\Http\Responses\Web\Menu\Child\ChildUpdateResponse;
use App\Http\Responses\Web\Menu\Child\ChildDeleteResponse;
use App\Http\Responses\Web\Menu\Child\ChildDeleteBulkResponse;
use App\Http\Responses\Web\Menu\Child\GetParentResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Menu\MenuChild;

class ChildController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        return new ChildResponse;
    }

    public function index()
    {
        $data['title']  = 'Manage Menu Child';
        return view('page.menu.child.view', $data);
    }

    public function add()
    {
        $data['title'] = 'Add New Menu Child';
        return view('page.menu.child.add', $data);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_child_name' => 'required|unique:menu_child,menu_child_name',
            'menu_child_url' => 'required|unique:menu_child,menu_child_url',
            'menu_parent_id' => 'required|exists:menu_parent,menu_parent_id',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new ChildSaveResponse();
    }

    public function edit($id, Request $request)
    {
        $data['data']  = MenuChild::where('menu_child_id', $id)->first();
        $data['title'] = 'Edit Data Menu Child';
        return view('page.menu.child.edit', $data);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_child_name' => [
                'required', Rule::unique('menu_child', 'menu_child_name')->where(function ($query) use($request){
                    return $query->where('menu_child_id', '!=', $request->menu_child_id);
                })
            ],
            'menu_child_url' => [
                'required', Rule::unique('menu_child', 'menu_child_url')->where(function ($query) use($request){
                    return $query->where('menu_child_id', '!=', $request->menu_child_id);
                })
            ],
            'menu_parent_id' => 'required|exists:menu_parent,menu_parent_id',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new ChildUpdateResponse();
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_child_id' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new ChildDeleteResponse;
    }

    public function bulkDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_child_id.*' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new ChildDeleteBulkResponse;
    }

    public function getParent(Request $request)
    {
        return new GetParentResponse;
    }
}
