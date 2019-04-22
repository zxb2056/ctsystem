<?php

namespace App\Imports;

use App\Tempworker;
use Maatwebsite\Excel\Concerns\ToModel;

class TempworkerImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Tempworker([
            //
           
        ]);
    }
}
