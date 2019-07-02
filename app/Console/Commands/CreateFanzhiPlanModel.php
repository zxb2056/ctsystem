<?php

namespace App\Console\Commands;

// use Illuminate\Console\Command;
use Illuminate\Foundation\Console\ModelMakeCommand;

class CreateFanzhiPlanModel extends ModelMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:fanzhiplan {name} {--migration} {--force} {--all} {--pivot} {--factory} {--controller} {--resource}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate fanzhiplan model';


    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('pivot')) {
            return __DIR__.'/stubs/pivot.model.stub';
        }
        return __DIR__.'/stubs/fanzhiplan.stub';
    }
    


}
