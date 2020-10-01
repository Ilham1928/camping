<?php

namespace App\Http\Responses\Web\News\Master;

use App\Models\News\News;
use Illuminate\Contracts\Support\Responsable;

class NewsDetailResponse implements Responsable
{
    public function toResponse($request)
    {
        $data['data'] = $this->data($request);
        $data['title'] = 'Detail Data News';
        return view('page.news.master.detail', $data);
    }

    protected function data($request)
    {
        return News::query()
            ->select($this->query())
            ->join('admin_master', 'admin_master.admin_id', '=', 'news_master.created_by')
            ->where('admin_master.status', '1')
            ->where('news_master.status', '1')
            ->where('news_id', $request->segment(3))
            ->first();
    }

    protected function query()
    {
        return [
            'news_id',
            'news_title',
            'news_content',
            'news_image',
            'admin_name as created_by',
            'news_master.created_at'
        ];
    }
}
