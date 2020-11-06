<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Illuminate\Database\Events\QueryExecuted' => [
            'App\Listeners\QueryListener'
        ],
        'App\Events\UserRegisterEvent' => [
            'App\Listeners\UserRegisterEventListener'
        ],
    ];

    protected $subscribe = [
        'App\Listeners\UserEventSubscriber',
    ];
}
