<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $fillable =   [
                                'user_id',
                                'fullname',
                                'email',
                                'password',
                                'address',
                                'id_card',
                                'role_id',
                                'token',
                                'status'
                            ];
    public function roles()
    {
        return $this->hasMany('App\Models\Admin\AdminRole');
    }
}
