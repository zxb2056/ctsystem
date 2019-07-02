<?php

namespace App\Imports;

use App\Models\CattleSireInfo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class SireInfoImport implements ToModel,WithHeadingRow,WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CattleSireInfo([
            //
            'sireRegi'=>$row['公牛注册号'],
            'semenNum'=>$row['冻精号'],
            'breedType'=>$row['品种'],
            'nation_id'=>$row['国家id'],
            'belongToCompany'=>$row['所属公司'],
            'CBI'=>$row['CBI'],
            'birthDay'=>$row['出生日期'],
            'BW'=>$row['BW'],
            'WW'=>$row['WW'],
            'YW'=>$row['YW'],
            'W18month'=>$row['18月龄重'],
            'W24month'=>$row['24月龄重'],
            'W36month'=>$row['36月龄重'],
            'level'=>$row['体型评级'],
            'CEM'=>$row['CEM'],
            'milk'=>$row['milk'],
            'MH'=>$row['MH'],
            'MW'=>$row['MW'],
            'CW'=>$row['CW'],
            'Marbling'=>$row['Marbling'],
            'REA'=>$row['REA'],
            'Fat'=>$row['背膘厚'],
            'FValue'=>$row['$F'],
            'GValue'=>$row['$G'],
            'QGValue'=>$row['$QG'],
            'YGValue'=>$row['$YG'],
            'BValue'=>$row['$B'],
        ]);
    }
}
