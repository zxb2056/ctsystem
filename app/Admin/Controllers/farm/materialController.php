<?php

namespace App\Admin\Controllers\farm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class materialController extends Controller
{
    //兽药
    public function drugs_input(){
        return view('admin.manager.material.drugs_input');
    }
    public function drugs_ledger(){
        return view('admin.manager.material.drugs_ledger');
    }
    public function drugs_output(){
        return view('admin.manager.material.drugs_output');
    }
    public function drugs_remain(){
        return view('admin.manager.material.drugs_remain');
    }
    public function drugs_repository(){
        return view('admin.manager.material.drugs_repository');
    }
    //饲料
    public function feed_input(){
        return view('admin.manager.material.feed_input');
    }
    public function feed_ledger(){
        return view('admin.manager.material.feed_ledger');
    }
    public function feed_output(){
        return view('admin.manager.material.feed_output');
    }
    public function feed_remain(){
        return view('admin.manager.material.feed_remain');
    }
    public function feed_repository(){
        return view('admin.manager.material.feed_repository');
    }
    public function instru_consum_check(){
        return view('admin.manager.material.instru_consum_check');
    }
    public function instru_consum_input(){
        return view('admin.manager.material.instru_consum_input');
    }
    public function instru_consum_output(){
        return view('admin.manager.material.instru_consum_output');
    }
    public function instru_consum_remain(){
        return view('admin.manager.material.instru_consum_remain');
    }
    public function instru_consum_ledger(){
        return view('admin.manager.material.instru_consum_ledger');
    }
    public function semen_broke_history(){
        return view('admin.manager.material.semen_broke_history');
    }
    public function semen_broke(){
        return view('admin.manager.material.semen_broke');
    }
    public function semen_ledger(){
        return view('admin.manager.material.semen_ledger');
    }
    public function semen_remain(){
        return view('admin.manager.material.semen_remain');
    }

}
