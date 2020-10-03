<?php

namespace App\Http\Responses\Web\Guide\Master;

use App\Models\Guide\Guide;
use Illuminate\Contracts\Support\Responsable;

class GuideSaveResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            $this->create($request);

            return response()->json([
                'code' => 200,
                'messsage' => 'Success',
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

    protected function create($request)
    {
        Guide::create([
            'guide_name' => $request->guide_name,
            'guide_experience' => $request->guide_experience,
            'guide_price' => $request->guide_price,
            'guide_birthday' => $request->guide_birthday,
            'guide_gender' => $request->guide_gender,
            'guide_available' => 1,
            'guide_photo' => $this->decodeImage($request->guide_photo),
            'status' => '1'
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
            \File::put(storage_path(). '/app/public/guide/' . $imageName, base64_decode($image));
        }

        return $imageName;
    }
}
