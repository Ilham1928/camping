<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    protected $table = 'item_category';
    protected $primaryKey = 'category_id';
    protected $fillable =   [
                                'category_id',
                                'category_name',
                                'status'
                            ];
}
