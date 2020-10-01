<?php

namespace App\Http\Responses\Web\News\Master;

use App\Models\News\News;
use Illuminate\Contracts\Support\Responsable;

class NewsResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            $data = $this->data($request);

            if (!$data->isEmpty()) {
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                    'pagination' => (string) $data->links()
                ], 200);
            }else{
                return response()->json([
                    'code' => 204,
                    'data' => 'No Data',
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'data' => $e->getMessage(),
            ], 200);
        }
    }

    protected function data($request)
    {
        return News::query()
            ->select($this->query())
            ->join('admin_master', 'admin_master.admin_id', '=', 'news_master.created_by')
            ->where('admin_master.status', '1')
            ->where('news_master.status', '1')
            ->paginate(10);
    }

    public function query()
    {
        return [
            'news_id',
            'news_title',
            'admin_name as created_by',
            'news_master.created_at'
        ];
    }
}
