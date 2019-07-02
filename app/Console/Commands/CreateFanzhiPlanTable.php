<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
class CreateFanzhiPlanTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:createfzptable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description--generate fanzhiplantable';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date=date('Y_m_d_h_i');
        //调用artisan ,可以用artisan::call,Artisan::queue(),在command中可以直接用$this->call
        $this->call('make:fanzhiplan',[
            'name'=>'Models/Breed_'.$date.'_FanzhiPlan',
        ]);
        // Schema::dropIfExists('breed_'.$date.'_expect_births');
        // Schema::create('breed_'.$date.'_expect_births', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('name')->nullable()->comment('test create');
        //     $table->timestamps();
        // });
        // $data=array(
        //     array('name'=>'zhangsan'),
        // );
        // // \DB::table('semen_infos')->insert($data);
        // $str='\App\Models\Breed_'.$date.'_FanzhiPlan';
        // $str::create($data);
        
    }
}
