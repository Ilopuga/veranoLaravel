<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Registra los servicios de la aplicación.
     *
     * @return void
     */
    public function register()
    {
        // Aquí puedes registrar los servicios de autenticación adicionales si es necesario.
    }

    /**
     * Registra las políticas de la aplicación.
     *
     * @return void
     */
    public function boot()
    {
        // Aquí puedes definir las políticas o "Gates" de tu aplicación
    }
}
