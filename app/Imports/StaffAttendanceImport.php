<?php

namespace App\Imports;

use App\Models\StaffAttendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StaffAttendanceImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new StaffAttendance([
            //
            'name'=>$row['名字'],
            'company'=>$row['公司名称'],
            'month'=>$row['年月'],
            'day1'=>$row['1'],
            'day2'=>$row['2'],
            'day3'=>$row['3'],
            'day4'=>$row['4'],
            'day5'=>$row['5'],
            'day6'=>$row['6'],
            'day7'=>$row['7'],
            'day8'=>$row['8'],
            'day9'=>$row['9'],
            'day10'=>$row['10'],
            'day11'=>$row['11'],
            'day12'=>$row['12'],
            'day13'=>$row['13'],
            'day14'=>$row['14'],
            'day15'=>$row['15'],
            'day16'=>$row['16'],
            'day17'=>$row['17'],
            'day18'=>$row['18'],
            'day19'=>$row['19'],
            'day20'=>$row['20'],
            'day21'=>$row['21'],
            'day22'=>$row['22'],
            'day23'=>$row['23'],
            'day24'=>$row['24'],
            'day25'=>$row['25'],
            'day26'=>$row['26'],
            'day27'=>$row['27'],
            'day28'=>$row['28'],
            'day29'=>$row['29'],
            'day30'=>$row['30'],
            'day31'=>$row['31'],
            
   
        ]);
    }
}
