<?php

namespace App\Http\Responses\Web\News\Master;

use App\Models\News\News;
use Illuminate\Contracts\Support\Responsable;

class NewsEditResponse implements Responsable
{
    public function toResponse($request)
    {
        $data['data'] = $this->data($request);
        $data['title'] = 'Edit Data News';

        return view('page.news.master.edit')->with($data);
    }

    protected function data($request)
    {
        return News::query()
            ->where('news_id', $request->segment(3))
            ->first();
    }
}
