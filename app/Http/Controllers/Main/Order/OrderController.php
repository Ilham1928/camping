<?php

namespace App\Http\Controllers\Main\Order;

use App\Models\Guide\Guide;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Models\Item\ItemMaster;
use App\Models\Order\OrderDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Responses\Web\Order\Master\OrderResponse;
use App\Http\Responses\Web\Order\Master\OrderSaveResponse;
use App\Http\Responses\Web\Order\Master\OrderDetailUpdateResponse;

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
        $data['title']  = 'Kelola Pesanan';
        return view('page.order.master.view')->with($data);
    }

    public function detail($id, Request $request)
    {
        $auth = $this->authorize('other');
        if (!$auth) {
            return $this->redirect();
        }

        $data['title'] = 'Detail Data Pesanan';
        $data['data']  = Order::query()
            ->select('order.*', 'user.fullname', 'user.id_card', 'user.email')
            ->addSelect('order.order_code')
            ->where('order.order_id', $id)
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

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'total_rental' => 'required|numeric',
            'qty' => 'required|numeric',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        return new OrderDetailUpdateResponse;
    }
}
