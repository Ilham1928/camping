<?php

namespace App\Http\Responses\Web\Order\Master;

use App\Models\Order\Order;
use App\Models\Order\OrderDetail;
use Illuminate\Contracts\Support\Responsable;

class OrderDetailUpdateResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            $order = $this->update($request);

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

    protected function update($request)
    {
        $orderDetail = OrderDetail::where('order_detail_id', $request->id)->first();
        $orderDetail->update([
            'total_rental' => $request->total_rental,
            'order_qty' => $request->qty,
        ]);

        return Order::query()
            ->select('order.*', 'user.fullname', 'user.id_card', 'user.email')
            ->addSelect('order.order_code')
            ->where('order.order_id', $orderDetail->order_id)
            ->leftJoin('user', 'user.user_id', '=', 'order.user_id')
            ->whereRaw("MONTH(`order_date`) = MONTH(CURDATE())")
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
    }
}
