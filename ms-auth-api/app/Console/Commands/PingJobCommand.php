<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\PingJob;
class PingJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ping:job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        PingJob::dispatch()->onConnection(env('QUEUE_ONE'))->onQueue('route_key_one');
        PingJob::dispatch()->onConnection(env('QUEUE_TWO'))->onQueue('route_key_two');
    }
}
