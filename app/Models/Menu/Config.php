<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'cms_config';
    protected $primaryKey = 'cms_config_id';
    protected $fillable =   [
                                'cms_config_brand',
                                'cms_config_skin',
                            ];
}
