<?php

namespace App\Http\Responses\Web\Guide\Master;

use App\Models\Guide\Guide;
use Illuminate\Contracts\Support\Responsable;

class GuideDeleteResponse implements Responsable
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
        Guide::where('guide_id', $request->guide_id)->update([ 'status' => '0' ]);
    }
}
