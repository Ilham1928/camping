<?php

namespace App\Http\Controllers\Main\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->get('user_type') == 'user') {
            $data['title'] = 'List Alat Camping';
            return view('page.dashboard.user.view', $data);
        }else{
            $data['title'] = 'Dashboard Analytic';
            return view('page.dashboard.admin.view', $data);
        }
    }
}
