<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define las rutas de la aplicación.
     *
     * @return void
     */
    public function boot()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Registra las rutas de la API.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             // Elimina la línea de $this->namespace
             ->group(base_path('routes/api.php'));
    }

    /**
     * Registra las rutas web.
     *
     * @return void
     */
    protected function mapWebRoutes()
{
    Route::middleware('web')
         ->group(base_path('routes/web.php'));
}
}
