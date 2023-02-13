<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;
use App\Jobs\PingJob;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\ExampleEvent::class => [
            \App\Listeners\ExampleListener::class,
        ],
    ];

        /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
          App::bindMethod(PingJob::class, '@handle', function ($job) {
            $job->handle();
        });
    }
}
