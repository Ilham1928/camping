<?php

namespace App\Http\Responses\Web\Guide\Master;

use App\Models\Guide\Guide;
use Illuminate\Contracts\Support\Responsable;

class GuideResponse implements Responsable
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
                    'data' => [],
                    'message' => 'No Data',
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'data' => [],
                'message' => $e->getMessage(),
            ], 200);
        }
    }

    protected function data($request)
    {
        return Guide::query()
            ->where('guide.status', '1')
            ->paginate(10);
    }
}
