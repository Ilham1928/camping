<?php

namespace App\Http\Responses\Web\Admin\Master;

use App\Models\Admin\AdminMaster;
use Illuminate\Contracts\Support\Responsable;

class AdminDetailResponse implements Responsable
{
    public function toResponse($request)
    {
        $data['data'] = $this->data($request);
        $data['title'] = 'Detail Data Admin';
        
        return view('page.admin.master.detail')->with($data);
    }

    protected function data($request)
    {
        return AdminMaster::query()
            ->join('admin_role', 'admin_role.role_id', '=', 'admin_master.role_id')
            ->where('admin_id', $request->segment(3))
            ->first();
    }
}
