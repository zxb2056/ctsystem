<?php

namespace App\Exports;

use App\Models\Cattle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CattleExportView implements FromView
{
    private $datas,$allCattles,$breedvarieties, $hasRepeat;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($datas,$allCattles,$breedvarieties,$hasRepeat)
    {
        $this->datas = $datas;
        $this->allCattles = $allCattles;
        $this->breedvarieties = $breedvarieties;
        $this->hasRepeat =  $hasRepeat;
    }
    public function view():View
    {
        return view('admin.manager.basic.cattletable',[
            'allCattles'=>$this->allCattles,
            'datas'=>$this->datas,
            'breedvarieties'=>$this->breedvarieties,
            'hasRepeat'=>$this->hasRepeat,
        ]);
    }
}
