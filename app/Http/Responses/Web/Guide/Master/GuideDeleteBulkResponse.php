<?php

namespace App\Http\Responses\Web\Guide\Master;

use App\Models\Guide\Guide;
use Illuminate\Contracts\Support\Responsable;

class GuideDeleteBulkResponse implements Responsable
{
    public function toResponse($request)
    {
        try {
            $this->delete($request);

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => new \stdClass
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
                'data' => new \stdClass
            ], 200);
        }
    }

    protected function delete($request)
    {
        foreach($request->guide_id as $guide_id){
            Guide::where('guide_id', $guide_id)->update([ 'status' => '0' ]);
        }
    }
}
