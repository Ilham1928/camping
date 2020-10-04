<?php

namespace App\Http\Responses\Web\Order\Master;

use App\Models\Order\Order;
use Illuminate\Contracts\Support\Responsable;

class OrderResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            $data = $this->data($request);

            if (!$data->isEmpty()) {
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                    'pagination' => (string) $data->links()
                ], 200);
            }else{
                return response()->json([
                    'code' => 204,
                    'data' => [],
                    'message' => 'No Data',
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'data' => [],
                'message' => $e->getMessage(),
            ], 200);
        }
    }

    protected function data($request)
    {
        return Order::query()
            ->with(['orderDetail' => function($query){
                $query->select('*')
                    ->selectRaw("SUM(order_detail.order_qty) as qty")
                    ->groupBy('order_detail.item_id');
            }])
            ->where('order.status', '1')
            ->paginate(10);
    }
}
