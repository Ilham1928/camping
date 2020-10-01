<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $table = 'admin_role';
    protected $primaryKey = 'role_id';
    protected $fillable =   [
                                'role_id',
                                'role_name',
                                'role_description',
                                'status'
                            ];

    public function roles()
    {
        return $this->belongsTo('App\Models\Admin\AdminMaster', 'role_id', 'role_id');
    }

    public function permission()
    {
        return $this->hasMany('App\Models\Admin\AdminRolePermission', 'role_id', 'role_id');
    }
}
