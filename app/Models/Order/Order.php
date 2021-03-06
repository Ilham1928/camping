<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'order_id';
    protected $fillable =   [
                                'order_id',
                                'user_id',
                                'order_code',
                                'total_price',
                                'order_date',
                                'order_type',
                                'order_note',
                                'is_cancel',
                                'is_checkout',
                                'status'
                            ];

    public function orderDetail()
    {
        return $this->hasMany('App\Models\Order\OrderDetail', 'order_id', 'order_id');
    }
}
