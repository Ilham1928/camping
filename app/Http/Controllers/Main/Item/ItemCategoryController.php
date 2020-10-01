<?php

namespace App\Http\Controllers\Main\Item;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Item\ItemCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Responses\Web\Item\Category\ItemCategoryResponse;
use App\Http\Responses\Web\Item\Category\ItemCategorySaveResponse;
use App\Http\Responses\Web\Item\Category\ItemCategoryUpdateResponse;
use App\Http\Responses\Web\Item\Category\ItemCategoryDeleteResponse;
use App\Http\Responses\Web\Item\Category\ItemCategoryDeleteBulkResponse;

class ItemCategoryController extends Controller
{
    public function getData(Request $request)
    {
        return new ItemCategoryResponse;
    }

    public function index(Request $request)
    {
        $auth = $this->authorize('view');
        if (!$auth) {
            return $this->redirect();
        }
        $data['title']  = 'Kelola Kategori Barang';
        return view('page.item.category.view')->with($data);
    }

    public function add()
    {
        $auth = $this->authorize('add');
        if (!$auth) {
            return $this->redirect();
        }
        $data['title'] = 'Tambah Kategori Barang';
        return view('page.item.category.add')->with($data);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|unique:item_category,category_name',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        return new ItemCategorySaveResponse;
    }

    public function edit($id, Request $request)
    {
        $auth = $this->authorize('edit');
        if (!$auth) {
            return $this->redirect();
        }

        $data['data']  = ItemCategory::where('category_id', $id)->first();
        $data['title'] = 'Edit Data Kategori';
        return view('page.item.category.edit')->with($data);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => [
                'required', Rule::unique('item_category', 'category_name')->where(function ($query) use($request){
                    return $query->where('category_id', '!=', $request->category_id);
                })
            ],
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        return new ItemCategoryUpdateResponse;
    }

    public function delete(Request $request)
    {
        $auth = $this->authorize('delete');
        if (!$auth) {
            $this->session();
            return response()->json(['code' => 200]);
        }

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        return new ItemCategoryDeleteResponse;
    }

    public function bulkDelete(Request $request)
    {
        $auth = $this->authorize('delete');
        if (!$auth) {
            $this->session();
            return response()->json(['code' => 200]);
        }

        $validator = Validator::make($request->all(), [
            'category_id.*' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        
        return new ItemCategoryDeleteBulkResponse;
    }
}
