<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\App;
use App\Jobs\UserCreated;
use App\Jobs\PingJob;
use App\Jobs\UserList;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        App::bindMethod(UserCreated::class, '@handle', function ($job) {
            $job->handle();
        });
        App::bindMethod(PingJob::class, '@handle', function ($job) {
            $job->handle();
        });
        App::bindMethod(UserList::class, '@handle', function ($job) {
        return $job->handle();
        });

    }
}
