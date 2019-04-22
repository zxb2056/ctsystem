<?php

namespace App\Admin\controllers\farm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BasicController extends Controller
{
    //
    public function index(){

        return view('admin.manager.basic.basic');
    }
    public function barninfo(){

        return view('admin.manager.basic.barninfo');
    }
    public function semen(){
        return view('admin.manager.basic.semen');
    }


}
