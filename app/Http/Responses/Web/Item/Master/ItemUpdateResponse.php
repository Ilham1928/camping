<?php

namespace App\Http\Responses\Web\Item\Master;

use App\Models\Item\ItemMaster;
use Illuminate\Contracts\Support\Responsable;

class ItemUpdateResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            $this->update($request);

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

    protected function update($request)
    {
        $item = ItemMaster::where('item_id', $request->item_id)->first();
        $image = (!empty($request->item_image)) ? $this->decodeImage($request->image) : $item->item_image;

        $item->update([
            'item_name'        => $request->item_name,
            'item_price'       => $request->item_price,
            'item_description' => $request->item_description,
            'category_id'      => $request->category_id,
            'item_image'       => $image,
            'item_stock'       => $request->item_stock,
            'status'           => '1'
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
