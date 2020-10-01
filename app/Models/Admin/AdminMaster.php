<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminMaster extends Model
{
    protected $table = 'admin_master';
    protected $primaryKey = 'admin_id';
    protected $fillable =   [
                                'admin_id',
                                'admin_name',
                                'admin_title',
                                'admin_description',
                                'admin_email',
                                'admin_password',
                                'admin_token',
                                'admin_photo',
                                'role_id',
                                'status'
                            ];
    public function roles()
    {
        return $this->hasMany('App\Models\Admin\AdminRole');
    }
}
