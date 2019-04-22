<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class UserController extends Controller
{
    //个人设置页面
    public function setting(Post $post)
    {
        // $this->authorize('setting',$post);
        return view('register.setting');
    }


}
