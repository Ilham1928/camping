<?php

namespace App\Http\Controllers\Main\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Admin\AdminMaster;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Responses\Web\Admin\Master\AdminResponse;
use App\Http\Responses\Web\Admin\Master\GetRolesResponse;
use App\Http\Responses\Web\Admin\Master\AdminSaveResponse;
use App\Http\Responses\Web\Admin\Master\AdminUpdateResponse;
use App\Http\Responses\Web\Admin\Master\AdminDeleteResponse;
use App\Http\Responses\Web\Admin\Master\AdminDeleteBulkResponse;

class AdminController extends Controller
{
    public function getData(Request $request)
    {
        return new AdminResponse;
    }

    public function index(Request $request)
    {
        $auth = $this->authorize('view');
        if (!$auth) {
            return $this->redirect();
        }
        $data['title']  = 'Manage Admin';
        return view('page.admin.master.view')->with($data);
    }

    public function add()
    {
        $auth = $this->authorize('add');
        if (!$auth) {
            return $this->redirect();
        }
        $data['title'] = 'Add New Admin';
        return view('page.admin.master.add')->with($data);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_name' => 'required',
            'admin_title' => 'required',
            'admin_description' => 'required|max:500',
            'admin_email' => 'required|email|unique:admin_master,admin_email',
            'admin_password' => 'required|min:6|max:20',
            // 'role_id' => 'required|exists:admin_role,role_id',
            'role_id' => 'required|numeric',
        ]);
        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new AdminSaveResponse();
    }

    public function detail($id, Request $request)
    {
        $auth = $this->authorize('other');
        if (!$auth) {
            return $this->redirect();
        }

        $data['data']  = AdminMaster::where('admin_id', $id)->first();
        $data['title'] = 'Detail Data Admin';
        return view('page.admin.master.detail')->with($data);
    }

    public function edit($id, Request $request)
    {
        $auth = $this->authorize('edit');
        if (!$auth) {
            return $this->redirect();
        }

        $data['data']  = AdminMaster::where('admin_id', $id)->first();
        $data['title'] = 'Edit Data Admin';
        return view('page.admin.master.edit')->with($data);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_name' => 'required',
            'admin_title' => 'required',
            'admin_description' => 'required|max:500',
            'admin_email' => 'required|email|unique:admin_master,admin_email',
            'role_id' => 'required|numeric',
            'admin_email' => [
                'email','required', Rule::unique('admin_master', 'admin_email')->where(function ($query) use($request){
                    return $query->where('admin_id', '!=', $request->admin_id);
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
            'admin_id' => 'required',
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
            'admin_id.*' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new AdminDeleteBulkResponse;
    }

    public function getRoles(Request $request)
    {
        return new GetRolesResponse;
    }
}
