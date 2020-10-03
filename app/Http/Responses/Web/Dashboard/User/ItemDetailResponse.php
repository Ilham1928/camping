<?php

namespace App\Http\Responses\Web\Dashboard\User;

use App\Models\Guide\Guide;
use App\Models\Item\ItemMaster;
use Illuminate\Contracts\Support\Responsable;

class ItemDetailResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            $data = $this->data($request);

            if ($data) {
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                ], 200);
            }else{
                return response()->json([
                    'code' => 204,
                    'data' => new \stdClass,
                    'message' => 'No Data',
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'data' => new \stdClass,
                'message' => $e->getMessage(),
            ], 200);
        }
    }

    protected function data($request)
    {
        if ($request->type == 'item') {
            return $this->item($request);
        }

        if ($request->type == 'guide') {
            return $this->guide($request);
        }

        return false;
    }

    protected function item($request)
    {
        return ItemMaster::query()
            ->with('category')
            ->where('item_master.status', '1')
            ->where('item_id', $request->id)
            ->first();
    }

    protected function guide($request)
    {
        return Guide::query()
            ->where('guide_id', $request->id)
            ->where('guide.status', '1')
            ->first();
    }
}
