<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminActivity extends Model
{
    protected $table = 'admin_activity';
    protected $primaryKey = 'activity_id';
    protected $fillable =   [
                                'activity_id',
                                'activity_name',
                                'activity_by',
                                'activity_detail',
                                'status'
                            ];
}
