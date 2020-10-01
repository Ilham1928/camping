<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Model;

class ItemMaster extends Model
{
    protected $table = 'item_master';
    protected $primaryKey = 'item_id';
    protected $fillable =   [
                                'item_id',
                                'category_id',
                                'item_name',
                                'item_description',
                                'item_price',
                                'item_image',
                                'item_stock',
                                'status'
                            ];
    public function category()
    {
        return $this->hasOne('App\Models\Item\ItemCategory', 'category_id', 'category_id')
            ->where('item_category.status', 1);
    }
}
