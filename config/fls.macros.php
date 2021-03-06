<?php

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Routing\Router;
use Laravel\Dusk\Browser;

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel\Dusk\Browser Macros
    |--------------------------------------------------------------------------
    | To install
    | composer require laravel/dusk
    |
    */
    Browser::class => [
        // 'firstWindow' => \Fls\Macros\Macros\Browser\FirstWindow::class,
        // 'lastWindow' => \Fls\Macros\Macros\Browser\LastWindow::class,
        // 'switchToFirstWindow' => \Fls\Macros\Macros\Browser\SwitchToFirstWindow::class,
        // 'switchToLastWindow' => \Fls\Macros\Macros\Browser\SwitchToLastWindow::class,
        // 'windows' => \Fls\Macros\Macros\Browser\Windows::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Illuminate\Database\Eloquent\Builder
    |--------------------------------------------------------------------------
    | Enabled by default
    |
    */
    Builder::class => [
        'toSqlWithBindings' => \Fls\Macros\Macros\Builder\ToSqlWithBindings::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Carbon\Carbon
    |--------------------------------------------------------------------------
    | startOfFiscalYear($at = null) will return the return of fiscal year
    |
    */
    Carbon::class => [
        'fiscalYearForHumans' => \Fls\Macros\Macros\Carbon\FiscalYearForHumans::class,
        'startOfFiscalYear' => \Fls\Macros\Macros\Carbon\StartOfFiscalYear::class,
        'endOfFiscalYear' => \Fls\Macros\Macros\Carbon\EndOfFiscalYear::class,
        'isFiscalYear' => \Fls\Macros\Macros\Carbon\IsFiscalYear::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Illuminate\Support\Collection
    |--------------------------------------------------------------------------
    | oxford() required Coduo\Humanize package
    | composer require coduo/php-humanizer
    |
    */
    Collection::class => [
        // 'ofxord' => \Fls\Macros\Macros\Collection\Oxford::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Illuminate\Database\Eloquent\Factories\Factory Macros
    |--------------------------------------------------------------------------
    | Enabled by default
    |
    */
    Factory::class => [
        'empty' => \Fls\Macros\Macros\Factory\EmptyFactory::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Illuminate\Routing\Router Macros
    |--------------------------------------------------------------------------
    | livewireResource() is just a shortcut to have a resource with [index, create, show, edit] methods only
    | but if you want to install LiveWire
    | composer require livewire/livewire
    |
    */
    Router::class => [
        'livewireResource' => \Fls\Macros\Macros\Router\LiveResource::class,
    ],
];
