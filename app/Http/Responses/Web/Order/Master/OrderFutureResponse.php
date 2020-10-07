<?php

namespace App\Http\Responses\Web\Order\Master;

use App\Models\Order\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Responsable;

class OrderFutureResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            return view('page.order.user.future.view')->with([
                'data' => $this->data($request),
                'title' => 'Data pesanan akan datang'
            ]);

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
            ->select('*')
            ->selectRaw("SUM(order_detail.order_qty) as qty")
            ->leftJoin('order_detail', 'order.order_id', '=', 'order_detail.order_id')
            ->groupBy('order_detail.order_id')
            ->whereRaw("MONTH(`order_date`) = MONTH(CURDATE())")
            ->where('order.status', '1')
            ->where('order.user_id', Session::get('user_id'))
            ->where('order.order_date', '>=', date('Y-m-d'))
            ->where('order.is_cancel', 0)
            ->paginate(10);
    }
}
