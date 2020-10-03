<?php

namespace App\Http\Controllers\Main\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\Web\Dashboard\User\DashboardResponse as DashboardUser;

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
}
