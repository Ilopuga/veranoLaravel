<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use App\Listeners\SomeListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Registra los eventos de la aplicación.
     *
     * @return void
     */
    public function boot()
    {
        // Si tienes eventos y listeners, puedes registrarlos aquí.
        // Por ejemplo, podrías tener algo como:
        // Event::listen('event.name', [SomeListener::class, 'handle']);
    }
}
