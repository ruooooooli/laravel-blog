<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Illuminate\Database\Events\QueryExecuted' => [
            'App\Listeners\QueryListener',
        ],
        'App\Events\Auth\LoginSuccess' => [
            'App\Listeners\Auth\LoginListener',
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
