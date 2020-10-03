<?php

namespace App\Http\Controllers\Main\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Responses\Web\Dashboard\User\DashboardResponse as DashboardUser;
use App\Http\Responses\Web\Dashboard\User\ItemDetailResponse;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->get('type') == 'user') {
            return new DashboardUser;
        }else{
            $data['title'] = 'Dashboard Analytic';
            return view('page.dashboard.admin.view', $data);
        }
    }

    public function detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:guide,item',
            'id' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        return new ItemDetailResponse;
    }
}
