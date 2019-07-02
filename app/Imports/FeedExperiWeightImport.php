<?php

namespace App\Imports;

use App\Models\PerformanceFeedExperiWeight;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class FeedExperiWeightImport implements ToModel,WithHeadingRow
{
    private $id;
    public function __construct($id){
        $this->id=$id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new PerformanceFeedExperiWeight([
            //
            'cattleID'=>$row['牛号'],
            'startWeight'=>$row['体重'],
            'experiment_id'=>$this->id,
        ]);
    }
}
