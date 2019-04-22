<?php

namespace App\Admin\controllers\farm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BreedController extends Controller
{
    //
    public function mateInput(){
        return view('admin.manager.breed.mateinput');
    }
    public function yunjianinput(){
        return view('admin.manager.breed.yunjianinput');
    }
    public function chandu(){
        return view('admin.manager.breed.chandu');
    }
    public function aftercare(){
        return view('admin.manager.breed.aftercare');
    }
    public function mateplan(){
        return view('admin.manager.breed.mateplan');
    }
    public function waitmate(){
        return view('admin.manager.breed.waitmate');
    }
    public function fanzhidisease(){
        return view('admin.manager.breed.fanzhidisease');
    }
    public function expected_birth(){
        return view('admin.manager.breed.expected_birth');
    }
    public function fanzhibaobiao(){
        return view('admin.manager.breed.fanzhibaobiao');
    }
}
