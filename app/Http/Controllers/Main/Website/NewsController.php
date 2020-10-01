<?php

namespace App\Http\Controllers\Main\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        return view('page.site.news-list')
            ->with(['title' => 'News List']);
    }

    public function detail(Request $request)
    {
        return view('page.site.news-detail')
            ->with(['title' => 'News Detail']);
    }
}
