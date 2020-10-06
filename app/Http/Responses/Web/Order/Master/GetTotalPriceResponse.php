<?php

namespace App\Http\Responses\Web\Order\Master;

use App\Models\Order\Order;
use App\Models\Order\OrderDetail;
use Illuminate\Contracts\Support\Responsable;

class GetTotalPriceResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            $order = $this->price($request);

            return response()->json([
                'code' => 200,
                'messsage' => 'Success',
                'data' => $order
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
                'data' => new \stdClass
            ], 200);
        }
    }

    protected function price($request)
    {
        $order = Order::query()
            ->select('*')
            ->addSelect('order.order_code')
            ->where('order.order_id', $request->id)
            ->where('order.status', '1')
            ->get()
            ->map(function($item){
                if ($item->order_type == 'Barang') {
                    $item['order_detail'] = OrderDetail::where('order_id', $item->order_id)
                        ->join('item_master', 'item_master.item_id', '=', 'order_detail.item_id')
                        ->get();
                }

                if ($item->order_type == 'Pemandu') {
                    $item['order_detail'] = OrderDetail::where('order_id', $item->order_id)
                        ->join('guide', 'guide.guide_id', '=', 'order_detail.item_id')
                        ->get();
                }

                return $item;
            })->first();

        return $order->order_detail->map(function($item) use($order){
            if ($order->order_type == 'Barang') {
                $data['total_price'] = $item->item_price * $item->order_qty * $item->total_rental;
            }

            if ($order->order_type == 'Pemandu') {
                $data['total_price'] = $item->guide_price * $item->order_qty * $item->total_rental;
            }
            return $data;
        })->sum('total_price');
    }
}
