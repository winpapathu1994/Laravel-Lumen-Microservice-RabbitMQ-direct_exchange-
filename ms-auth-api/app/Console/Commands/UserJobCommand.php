<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Jobs\UserCreated;
class UserJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User Job Command description';

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
         UserCreated::dispatch(User::inRandomOrder()->first()->toArray())->onConnection(env('QUEUE_ONE'))->onQueue('route_key_one');
    }
}
