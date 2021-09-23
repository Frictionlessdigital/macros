<?php

namespace Fls\Macros;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class MacrosServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/fls.macros.php' => config_path('fls.macros.php'),
        ]);
    }

    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/fls.macros.php', 'fls.macros');

        $this->macroables()->each(function ($macros, $macroable) {
            $macros->each(fn ($class, $macro) => $macroable::macro($macro, app($class)()));
        });
    }

    /**
     * Collect macros.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function macroables(): Collection
    {
        return collect($this->app['config']->get('fls.macros', []))->mapInto(Collection::class);
    }
}
