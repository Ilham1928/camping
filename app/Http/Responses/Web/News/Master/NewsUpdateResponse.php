<?php

namespace App\Http\Responses\Web\News\Master;

use App\Models\News\News;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Responsable;
use App\Http\Controllers\Controller;

class NewsUpdateResponse extends Controller implements Responsable
{
    public function toResponse($request)
    {
        try {
            $this->update($request);

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => new \stdClass
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
                'data' => new \stdClass
            ], 200);
        }
    }

    protected function update($request)
    {
        $news = News::where('news_id', $request->news_id)->first();

        $image = $news->news_image;
        if (!empty($request->news_image) && $request->news_image !== 'false') {
            $image = $this->decodeImage($request->news_image);
        }

        News::where('news_id', $request->news_id)->update([
            'news_title'   => $request->news_title,
            'news_content' => $request->news_content,
            'news_image'   => $image,
            'status'       => '1',
            'created_by'   => Session::get('admin_id'),
            'created_at'   => date('Y-m-d H:i:s')
        ]);

        $this->activity([
            'activity_name' => 'Update Data News'. $request->admin_email,
            'activity_by' => Session::get('admin_name'),
            'activity_detail' => 'Update data admin at '.date('D m, Y H:i')
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
            \File::put(storage_path(). '/app/public/news/' . $imageName, base64_decode($image));
        }

        return $imageName;
    }
}
