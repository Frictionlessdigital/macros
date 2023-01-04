<?php

namespace Fls\Macros;

use Illuminate\Support\Collection;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MacrosServiceProvider extends PackageServiceProvider
{
    /**
     * @param \Spatie\LaravelPackageTools\Package $package
     * @return void
     */
    public function configurePackage(Package $package): void
    {
        $package
            ->name('fls.macros')
            ->hasConfigFile();
    }

    /**
     * Register macros.
     *
     * @return void
     */
    public function packageRegistered()
    {
        $this->macroables()->each(function (Collection $macros, $macroable) {
            $macros->each(fn ($class, $macro) => $macroable::macro($macro, app($class)()));
        });
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    protected function macroables(): Collection
    {
        return collect($this->app['config']->get('fls.macros', []))->mapInto(Collection::class);
    }
}
