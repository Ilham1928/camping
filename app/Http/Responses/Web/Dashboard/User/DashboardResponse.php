<?php

namespace App\Http\Responses\Web\Dashboard\User;

use App\Models\Guide\Guide;
use App\Models\Item\ItemMaster;
use Illuminate\Contracts\Support\Responsable;

class DashboardResponse implements Responsable
{
    public function toResponse($request)
    {
        return view('page.dashboard.user.view')->with([
            'data' => $this->data($request),
            'title' => 'List Alat Camping & Guide'
        ]);
    }

    protected function data($request)
    {
        return [
            'item' => $this->item($request),
            'guide' => $this->guide($request)
        ];
    }

    protected function item($request)
    {
        return ItemMaster::query()
            ->with('category')
            ->where('item_master.status', '1')
            ->paginate(8);
    }

    protected function guide($request)
    {
        return Guide::query()
            ->where('guide.status', '1')
            ->paginate(10);
    }
}
