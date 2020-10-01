<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;

class MenuChild extends Model
{
    protected $table = 'menu_child';
    protected $primaryKey = 'menu_child_id';
    protected $fillable =   [
                                'menu_child_name',
                                'menu_child_url',
                                'menu_parent_id',
                                'status'
                            ];

}
