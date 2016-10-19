<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * 后台首页
 */
class IndexController extends Controller
{
    /**
     * 首页
     */
    public function index()
    {
        return view('backend.index.index');
    }
}
