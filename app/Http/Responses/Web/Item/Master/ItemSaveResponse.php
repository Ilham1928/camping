<?php

namespace App\Http\Responses\Web\Item\Master;

use App\Models\Item\ItemMaster;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Responsable;

class ItemSaveResponse extends Controller implements Responsable
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
        ItemMaster::create([
            'item_name'        => $request->item_name,
            'item_price'       => $request->item_price,
            'item_description' => $request->item_description,
            'category_id'      => $request->category_id,
            'item_image'       => $this->decodeImage($request->item_image),
            'item_stock'       => $request->item_stock,
            'status'           => '1'
        ]);

        $this->activity([
            'activity_name' => 'Create New Item',
            'activity_by' => Session::get('admin_name'),
            'activity_detail' => 'Create new item at '.date('D m, Y H:i')
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
            \File::put(storage_path(). '/app/public/item/' . $imageName, base64_decode($image));
        }

        return $imageName;
    }
}
