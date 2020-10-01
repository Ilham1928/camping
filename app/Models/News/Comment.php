<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $primaryKey = 'comment_id';
    protected $fillable =   [
                                'comment_id',
                                'news_id',
                                'comment_name',
                                'comment_email',
                                'comment_content',
                                'created_at',
                                'updated_at',
                                'status'
                            ];
    public function roles()
    {
        return $this->belongTo('App\Models\News\News');
    }
}
