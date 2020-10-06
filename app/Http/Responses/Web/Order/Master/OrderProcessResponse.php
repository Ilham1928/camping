<?php

namespace App\Http\Responses\Web\Order\Master;

use App\Models\Order\Order;
use Illuminate\Support\Str;
use App\Models\Order\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Responsable;

class OrderProcessResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            DB::transaction(function () use($request) {
                return $this->update($request);
            });

            return response()->json([
                'code' => 200,
                'messsage' => 'Success',
                'data' => new \stdClass
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
                'data' => new \stdClass
            ], 200);
        }
    }

    protected function update($request)
    {
        Order::where('order_id', $request->id)
            ->update([
                'total_price' => $request->total_price,
                'order_note' => $request->note,
                'is_cancel' => 0
            ]);
    }
}
