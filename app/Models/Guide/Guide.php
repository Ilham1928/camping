<?php

namespace App\Models\Guide;

use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    protected $table = 'guide';
    protected $primaryKey = 'guide_id';
    protected $fillable =   [
                                'guide_id',
                                'guide_name',
                                'guide_gender',
                                'guide_birthday',
                                'guide_experience',
                                'guide_photo',
                                'guide_available',
                                'status'
                            ];
}
