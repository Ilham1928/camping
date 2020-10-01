<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminRolePermission extends Model
{
    protected $table = 'admin_role_permission';
    protected $primaryKey = 'permission_id';
    protected $fillable =   [
                                'permission_id',
                                'role_id',
                                'menu_id',
                                'menu_view',
                                'menu_add',
                                'menu_edit',
                                'menu_delete',
                                'menu_other',
                                'status'
                            ];
}
