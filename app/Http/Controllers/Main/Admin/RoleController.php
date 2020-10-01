<?php

namespace App\Http\Controllers\Main\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Admin\AdminRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Responses\Web\Admin\Role\RoleResponse;
use App\Http\Responses\Web\Admin\Role\RoleSaveResponse;
use App\Http\Responses\Web\Admin\Role\RoleUpdateResponse;
use App\Http\Responses\Web\Admin\Role\RoleDeleteResponse;
use App\Http\Responses\Web\Admin\Role\RoleDeleteBulkResponse;

class RoleController extends Controller
{
    public function getData(Request $request)
    {
        return new RoleResponse;
    }

    public function index(Request $request)
    {
        $auth = $this->authorize('view');
        if (!$auth) {
            return $this->redirect();
        }

        $data['title']  = 'Manage Roles';
        return view('page.admin.role.view')->with($data);
    }

    public function add()
    {
        $auth = $this->authorize('add');
        if (!$auth) {
            return $this->redirect();
        }

        $data['title'] = 'Add New Roles';
        return view('page.admin.role.add')->with($data);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|unique:admin_role,role_name',
            'role_description' => 'required|max:500',
        ]);
        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new RoleSaveResponse;
    }

    public function edit($id, Request $request)
    {
        $data['data']  = AdminRole::where('role_id', $id)->first();
        $data['title'] = 'Edit Data Role';
        return view('page.admin.role.edit')->with($data);
    }

    public function update($id, Request $request)
    {
        $auth = $this->authorize('edit');
        if (!$auth) {
            return $this->redirect();
        }

        $validator = Validator::make($request->all(), [
            'role_id' => 'required|numeric',
            'role_description' => 'required|max:500',
            'role_name' => [
                'required', Rule::unique('admin_role', 'role_name')->where(function ($query) use($request){
                    return $query->where('role_id', '!=', $request->role_id);
                })
            ],
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new RoleUpdateResponse();
    }

    public function delete(Request $request)
    {
        $auth = $this->authorize('delete');
        if (!$auth) {
            $this->session();
            return response()->json(['code' => 200]);
        }

        $validator = Validator::make($request->all(), [
            'role_id' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new RoleDeleteResponse;
    }

    public function bulkDelete(Request $request)
    {
        $auth = $this->authorize('delete');
        if (!$auth) {
            $this->session();
            return response()->json(['code' => 200]);
        }

        $validator = Validator::make($request->all(), [
            'role_id.*' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }
        return new RoleDeleteBulkResponse;
    }
}
