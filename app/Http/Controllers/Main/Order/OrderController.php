<?php

namespace App\Http\Controllers\Main\Order;

use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Responses\Web\Order\Master\OrderResponse;
use App\Http\Responses\Web\Order\Master\OrderSaveResponse;

class OrderController extends Controller
{
    public function getData(Request $request)
    {
        return new OrderResponse;
    }

    public function index(Request $request)
    {
        $auth = $this->authorize('view');
        if (!$auth) {
            return $this->redirect();
        }
        $data['title']  = 'Kelola Barang';
        return view('page.order.master.view')->with($data);
    }

    public function detail($id, Request $request)
    {
        $auth = $this->authorize('other');
        if (!$auth) {
            return $this->redirect();
        }

        $data['title'] = 'Detail Data Pesanan';
        $data['data']  = Order::where('order_id', $id)
            ->with('orderDetail')
            ->first();

        return view('page.order.master.detail')->with($data);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'type' => 'required|in:item,guide',
            'total_rental' => 'required|numeric',
            'qty' => 'required|numeric',
            'date' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        return new OrderSaveResponse;
    }
}
