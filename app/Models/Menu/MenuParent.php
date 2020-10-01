<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;

class MenuParent extends Model
{
    protected $table = 'menu_parent';
    protected $primaryKey = 'menu_parent_id';
    protected $fillable =   [
                                'menu_parent_name',
                                'menu_icon_id',
                                'status'
                            ];

    public function child()
    {
         return $this->hasMany('App\Models\Menu\MenuChild', 'menu_parent_id');
    }

    public function icon()
    {
        return $this->belongsTo('App\Models\Menu\Icon', 'menu_icon_id');
    }
}
