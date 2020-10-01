<?php

namespace App\Http\Responses\Web\News\Master;

use App\Models\News\News;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Responsable;

class NewsSaveResponse extends Controller implements Responsable
{
    public function toResponse($request)
    {
        try {
            $this->create($request);

            $data['code'] = 200;
            $data['message'] = 'Success';
        } catch (Exception $e) {
            $data['code'] = 500;
            $data['message'] = $e->getMessage();
        }
        return response()->json($data);
    }

    protected function create($request)
    {
        News::create([
            'news_title'  => $request->news_title,
            'news_content' => $request->news_content,
            'news_image'   => $this->decodeImage($request->news_image),
            'status'       => '1',
            'created_by'   => Session::get('admin_id'),
            'created_at'   => date('Y-m-d H:i:s')
        ]);

        $this->activity([
            'activity_name' => 'Create New News',
            'activity_by' => Session::get('admin_name'),
            'activity_detail' => 'Create new news at '.date('D m, Y H:i')
        ]);
    }

    protected function decodeImage($file)
    {
        $imageName = "";
        if (!empty($file) && $file !== "false") {
            preg_match("/data\:image\/(.*)\;base64/",$file, $extension);
            $image = str_replace('data:image/'.$extension[1].';base64,', '', $file);
            $image = str_replace(' ', '+', $image);
            $imageName = str_random(10).'.'.$extension[1];
            \File::put(storage_path().'/app/public/news/'. $imageName, base64_decode($image));
        }
        return $imageName;
    }
}
