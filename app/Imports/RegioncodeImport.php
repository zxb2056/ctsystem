<?php

namespace App\Imports;

use App\Models\Regioncode;
use Maatwebsite\Excel\Concerns\ToModel;

class RegioncodeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Regioncode([
            //
            'regioncode'=>$row[1],
            'divisions'=>$row[2],
        ]);
    }
}
