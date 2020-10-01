<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $table = 'menu_icon';
    protected $primaryKey = 'menu_icon_id';
    protected $fillable =   [
                                'menu_icon_name',
                                'menu_icon_class',
                                'menu_icon_brand',
                                'menu_icon_unicode',
                                'status'
                            ];
}
