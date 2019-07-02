<?php

namespace App\Imports;

use App\Models\Cattle;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class CattleImport implements ToModel,WithHeadingRow,WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Cattle([
            //
            'cattleID'=>$row['牛耳号'],
            'birthday'=>$row['出生日期'],
            'birthWeight'=>$row['出生重'],
            'gender'=>$row['性别'],
            'whichBreed'=>$row['品种id'],
            'whereComefrom'=>$row['来源地'],
            'enterDay'=>$row['进场日期'],
            'enterWeight'=>$row['进场体重'],
            'status'=>$row['在群状态']

        ]);
    }
}
