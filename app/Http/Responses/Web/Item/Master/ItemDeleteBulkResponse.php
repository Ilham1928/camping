<?php

namespace App\Http\Responses\Web\Item\Master;

use App\Models\Item\ItemMaster;
use Illuminate\Contracts\Support\Responsable;

class ItemDeleteBulkResponse implements Responsable
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
        foreach($request->item_id as $item_id){
            ItemMaster::where('item_id', $item_id)->update([ 'status' => '0' ]);
        }
    }
}
