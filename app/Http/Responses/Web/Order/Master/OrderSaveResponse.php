<?php

namespace App\Http\Responses\Web\Order\Master;

use App\Models\Order\Order;
use Illuminate\Support\Str;
use App\Models\Order\OrderDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Responsable;

class OrderSaveResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            $this->create($request);

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

    protected function create($request)
    {
        $order = Order::create([
            'user_id' => Session::get('user_id'),
            'order_code' => 'Spader - ' . date('Y-m-d') . '-' . Str::uuid(),
            'order_date' => $request->date,
            'order_type' => $request->type,
            'status' => '1'
        ]);

        OrderDetail::create([
            'order_id' => $order->order_id,
            'item_id' => $request->id,
            'total_rental' => $request->total_rental,
            'order_qty' => $request->qty,
            'status' => 1
        ]);
    }
}
