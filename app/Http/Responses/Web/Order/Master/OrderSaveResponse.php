<?php

namespace App\Http\Responses\Web\Order\Master;

use App\Models\Order\Order;
use Illuminate\Support\Str;
use App\Models\Order\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Responsable;

class OrderSaveResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            DB::transaction(function () use($request) {
                return $this->create($request);
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

    protected function create($request)
    {
        $type =  ($request->type == 'item') ? 'Barang' : 'Pemandu';
        $order = Order::where('user_id', Session::get('user_id'))
            ->where('order_date', '>', date('Y-m-d'))
            ->where('order_type', $type)
            ->first();

        if (!$order) {
            $order = Order::create([
                'user_id' => Session::get('user_id'),
                'order_code' => 'Spader - ' . date('Ymd') . rand(),
                'order_date' => $request->date,
                'order_type' => ($request->type == 'item') ? 'Barang' : 'Pemandu',
                'is_checkout' => 0,
                'status' => '1'
            ]);
        }

        OrderDetail::create([
            'order_id' => $order->order_id,
            'item_id' => $request->id,
            'total_rental' => $request->total_rental,
            'order_qty' => $request->qty,
            'status' => 1
        ]);
    }
}
