<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    protected $primaryKey = 'order_detail_id';
    protected $fillable =   [
                                'order_detail_id',
                                'order_id',
                                'item_id',
                                'total_rental',
                                'order_qty',
                                'status',
                                'status'
                            ];
}
