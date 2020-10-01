<?php

namespace App\Http\Responses\Web\Admin\Master;

use App\Models\Admin\AdminMaster;
use Illuminate\Contracts\Support\Responsable;

class AdminEditResponse implements Responsable
{
    public function toResponse($request)
    {
        $data['data'] = $this->data($request);
        $data['title'] = 'Edit Data Admin';

        return view('page.admin.master.edit')->with($data);
    }

    protected function data($request)
    {
        return AdminMaster::query()
            ->where('admin_id', $request->segment(3))
            ->first();
    }
}
