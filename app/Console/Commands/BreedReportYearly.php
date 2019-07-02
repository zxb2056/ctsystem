<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BreedReportYearly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'breed:reportyearly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description:create breed report yearly';

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
        //
    }
}
