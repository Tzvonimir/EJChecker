<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'tymon.jwt.absent' => [
            'App\Listeners\JwtNoTokenListener',
        ],
        'tymon.jwt.expired' => [
            'App\Listeners\JwtExpiredTokenListener',
        ],
        'tymon.jwt.invalid' => [
            'App\Listeners\JwtInvalidTokenListener',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
