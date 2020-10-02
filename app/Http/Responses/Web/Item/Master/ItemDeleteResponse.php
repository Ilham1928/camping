<?php

namespace App\Http\Responses\Web\Item\Master;

use App\Models\Item\ItemMaster;
use Illuminate\Contracts\Support\Responsable;

class ItemDeleteResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            $this->delete($request);

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => new \stdClass
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
                'data' => new \stdClass
            ], 200);
        }
    }

    protected function delete($request)
    {
        ItemMaster::where('item_id', $request->item_id)->update([ 'status' => '0' ]);
    }
}
