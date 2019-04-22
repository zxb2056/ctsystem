<?php

namespace App\Admin\Controllers\farm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VeterController extends Controller
{
    //
    public function disease_input(){
        return view('admin.manager.Veterinary.disease_input');
    }
    public function antiepidemic_batch(){
        return view('admin.manager.Veterinary.antiepidemic_batch');
    }
    public function antiepidemic_single(){
        return view('admin.manager.Veterinary.antiepidemic_single');
    }
    public function antiepidemic_history(){
        return view('admin.manager.Veterinary.antiepidemic_history');
    }
    public function Quarantine_input(){
        return view('admin.manager.Veterinary.Quarantine_input');
    }
    public function Quarantine_history(){
        return view('admin.manager.Veterinary.Quarantine_history');
    }
    public function trim_hoof_input(){
        return view('admin.manager.Veterinary.trim_hoof_input');
    }
    public function trim_hoof_history(){
        return view('admin.manager.Veterinary.trim_hoof_history');
    }
    public function repellent_single(){
        return view('admin.manager.Veterinary.repellent_single');
    }
    public function repellent_batch(){
        return view('admin.manager.Veterinary.repellent_batch');
    }
    public function repellent_history(){
        return view('admin.manager.Veterinary.repellent_history');
    }
    public function disinfection_input(){
        return view('admin.manager.Veterinary.disinfection_input');
    }
    public function disinfection_history(){
        return view('admin.manager.Veterinary.disinfection_history');
    }

}
