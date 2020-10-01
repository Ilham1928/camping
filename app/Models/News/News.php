<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news_master';
    protected $primaryKey = 'news_id';
    protected $fillable =   [
                                'news_id',
                                'news_title',
                                'news_image',
                                'news_content',
                                'created_by',
                                'created_at',
                                'updated_at',
                                'status'
                            ];
    public function comment()
    {
        return $this->hasMany('App\Models\News\Comment', 'news_id', 'news_id');
    }
}
