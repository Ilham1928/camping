<?php

namespace App\Http\Controllers;

use \Firebase\JWT\JWT;
use App\Models\Menu\Config;
use Illuminate\Http\Request;
use App\Models\Menu\MenuParent;
use App\Models\Menu\MenuChild;
use App\Models\Admin\AdminActivity;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\AdminRolePermission;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __construct(Request $request=null)
    {
        $this->request = $request;
        $config = Config::where('cms_config_id', '1')->first();
        Session::put([
            'brand' => $config->cms_config_brand,
            'skin' => $config->cms_config_skin
        ]);

        $menu  = MenuParent::with('icon')
                            ->with('child')
                            ->where('status', '1')
                            ->get();

        View::share('menu', $menu);
    }

    public function authorize($param="")
    {
        $token = Session::get('admin_token');
        try {
            $role = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
            $permissions = AdminRolePermission::join('admin_role', 'admin_role.role_id', '=', 'admin_role_permission.role_id')
                                                ->join('menu_child', 'menu_child.menu_child_id', '=', 'admin_role_permission.menu_id')
                                                ->where('admin_role_permission.role_id', $role->role_id)
                                                ->where('admin_role.status', '1')
                                                ->get();

            foreach($permissions as $permission){
                if (!empty($param) && $param == 'view') {
                    if (strpos($this->request->path(), $permission['menu_child_url']) !== false) {
                        return $this->authView($permission);
                    }
                }

                if (!empty($param) && $param == 'add') {
                    if (strpos($this->request->path(), $permission['menu_child_url']) !== false) {
                        return $this->authAdd($permission);
                    }
                }

                if (!empty($param) && $param == 'edit') {
                    if (strpos($this->request->path(), $permission['menu_child_url']) !== false) {
                        return $this->authEdit($permission);
                    }
                }

                if (!empty($param) && $param == 'delete') {
                    if (strpos($this->request->path(), $permission['menu_child_url']) !== false) {
                        return $this->authDelete($permission);
                    }
                }

                if (!empty($param) && $param == 'other') {
                    if (strpos($this->request->path(), $permission['menu_child_url']) !== false) {
                        return $this->authOther($permission);
                    }
                }
            }
            Session::forget('error');
            return true;
        } catch (\Exception $e) {
            return back('/dashboard')->with('error', $e->getMessage());
        }
    }

    private function authView($permission)
    {
        return $result = ($permission['menu_view'] == '1') ? true : false;
    }

    private function authAdd($permission)
    {
        return $result = ($permission['menu_add'] == '1') ? true : false;
    }

    private function authEdit($permission)
    {
        return $result = ($permission['menu_edit'] == '1') ? true : false;
    }

    private function authDelete($permission)
    {
        return $result = ($permission['menu_delete'] == '1') ? true : false;
    }

    private function authOther($permission)
    {
        return $result = ($permission['menu_other'] == '1') ? true : false;
    }

    public function redirect()
    {
        return back()->with('error', 'You have not access for that module');
    }

    public function session()
    {
        Session::put(['error' => 'You have not access for that module']);
    }

    public function activity($param=[])
    {
        AdminActivity::insert($param);
    }
}
