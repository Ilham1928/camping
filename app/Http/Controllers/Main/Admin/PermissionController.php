<?php

namespace App\Http\Controllers\Main\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\AdminRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Responses\Web\Admin\Permission\PermissionResponse;
use App\Http\Responses\Web\Admin\Permission\PermissionSaveResponse;

class PermissionController extends Controller
{
    public function getData(Request $request)
    {
        return new PermissionResponse;
    }

    public function index($id, Request $request)
    {
        $auth = $this->authorize('other');
        if (!$auth) {
            return $this->redirect();
        }

        $data['title']   = 'Manage Permission';
        $data['data']    = AdminRole::where('role_id', $id)->where('status', '1')->first();
        return view('page.admin.permission.view')->with($data);
    }

    public function save($id, Request $request)
    {
        return new PermissionSaveResponse($id);
    }
}
