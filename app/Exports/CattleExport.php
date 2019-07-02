<?php

namespace App\Exports;

use App\Models\Cattle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class CattleExport implements FromArray, WithHeadings
{
    private $i = 1;
    protected $cattles;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(array $cattles)
    {
        $this->cattles = $cattles;
    }
    public function array():array
    {
        return $this->cattles;
        
    }
    public function headings():array
    {
        return [
            'id',
            '牛号',
            '出生日期',
            '出生重',
            '性别',
            '品种',
            '来源地',
            '进场日期',
            '进场体重',
            '胎次',
            '牛舍号',
            '在群状态',
            '创建日期',
            '更新日期',

        ];
    }

}
