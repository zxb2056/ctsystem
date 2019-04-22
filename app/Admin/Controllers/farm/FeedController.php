<?php

namespace App\Admin\Controllers\farm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedController extends Controller
{
    //
    public function dieOut(){
        return view('admin.manager.Feed.dieOut');
    }
    public function sell(){
        return view('admin.manager.Feed.sell');
    }
    public function sell_batch(){
        return view('admin.manager.Feed.sell_batch');
    }
    public function zhuanshe(){
        return view('admin.manager.Feed.zhuanshe');
    }
}
