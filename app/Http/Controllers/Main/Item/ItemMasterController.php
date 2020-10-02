<?php

namespace App\Http\Controllers\Main\Item;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Admin\AdminMaster;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Responses\Web\Item\Master\ItemResponse;
use App\Http\Responses\Web\Item\Master\ItemSaveResponse;
use App\Http\Responses\Web\Item\Master\GetCategoryResponse;

class ItemMasterController extends Controller
{
    public function getData(Request $request)
    {
        return new ItemResponse;
    }

    public function index(Request $request)
    {
        $auth = $this->authorize('view');
        if (!$auth) {
            return $this->redirect();
        }
        $data['title']  = 'Kelola Barang';
        return view('page.item.master.view')->with($data);
    }

    public function add()
    {
        $auth = $this->authorize('add');
        if (!$auth) {
            return $this->redirect();
        }
        $data['title'] = 'Tambah Data Barang';
        return view('page.item.master.add')->with($data);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required',
            'item_price' => 'required|numeric|min:1',
            'item_description' => 'required|max:500',
            'item_stock' => 'required',
            'category_id' => 'required|exists:item_category,category_id',
            'item_image' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        return new ItemSaveResponse;
    }

    public function detail($id, Request $request)
    {
        $auth = $this->authorize('other');
        if (!$auth) {
            return $this->redirect();
        }

        $data['data']  = AdminMaster::where('item_id', $id)->first();
        $data['title'] = 'Detail Data Admin';
        return view('page.admin.master.detail')->with($data);
    }

    public function edit($id, Request $request)
    {
        $auth = $this->authorize('edit');
        if (!$auth) {
            return $this->redirect();
        }

        $data['data']  = AdminMaster::where('item_id', $id)->first();
        $data['title'] = 'Edit Data Admin';
        return view('page.admin.master.edit')->with($data);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required',
            'item_title' => 'required',
            'item_description' => 'required|max:500',
            'item_email' => 'required|email|unique:item_master,item_email',
            'role_id' => 'required|numeric',
            'item_email' => [
                'email','required', Rule::unique('item_master', 'item_email')->where(function ($query) use($request){
                    return $query->where('item_id', '!=', $request->item_id);
                })
            ],
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new AdminUpdateResponse();
    }

    public function delete(Request $request)
    {
        $auth = $this->authorize('delete');
        if (!$auth) {
            $this->session();
            return response()->json(['code' => 200]);
        }

        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new AdminDeleteResponse;
    }

    public function bulkDelete(Request $request)
    {
        $auth = $this->authorize('delete');
        if (!$auth) {
            $this->session();
            return response()->json(['code' => 200]);
        }

        $validator = Validator::make($request->all(), [
            'item_id.*' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new AdminDeleteBulkResponse;
    }

    public function getCategory(Request $request)
    {
        return new GetCategoryResponse;
    }
}
