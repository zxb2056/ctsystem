<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //新增命令
        \App\Console\Commands\DemoCron::class,
        // 测试繁殖计划模型命令
        // \App\Console\Commands\CreateFanzhiPlanModel::class,
        // 测试生成繁殖计划年表
        // \App\Console\Commands\CreateFanzhiPlanTable::class,
        // 年繁殖计划表
        \App\Console\Commands\BreedYearly::class,
        // 月度繁殖计划表
        \APP\Console\Commands\BreedMonth::class,
        // 月度繁殖报表
        \App\Console\Commands\BreedReportMonth::class,
        // 年度繁殖报表
        \App\Console\Commands\BreedReportYearly::class,
      
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('demo:cron')
                 ->everyMinute();
        // $schedule->command('command:createfzptable')
                // ->everyMinute();
        // 年度繁殖计划表
        // $schedule->command('breed:yearly')
        // ->everyMinute();
        // 月度繁殖计划表
        // $schedule->command('breed:month')
        // ->everyMinute();    
        // 月度繁殖报表
         $schedule->command('breed:reportmonth')
        ->everyMinute();   

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
