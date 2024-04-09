<?php

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
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

    /*
    |--------------------------------------------------------------------------
    | Illuminate\Support\Str macros
    |--------------------------------------------------------------------------
    | safeFilename() will ensure the argument can be used as a filename
    |
    */
    Str::class => [
        'toBase64' => \Fls\Macros\Macros\Str\ToBase64::class,
        'safeFilename' => \Fls\Macros\Macros\Str\SafeFilename::class,
        'fromBase64' => \Fls\Macros\Macros\Str\FromBase64::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Illuminate\Support\Stringable macros
    |--------------------------------------------------------------------------
    | safeFilename() will ensure the argument can be used as a filename
    |
    */
    Stringable::class => [
        'fromBase64' => \Fls\Macros\Macros\Stringable\FromBase64::class,
        'safeFilename' => \Fls\Macros\Macros\Stringable\SafeFilename::class,
        'toBase64' => \Fls\Macros\Macros\Stringable\ToBase64::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | \Illuminate\Http\UploadedFile
    |--------------------------------------------------------------------------
    | MakeSafeUploadName() will sanitize the string to be an acceptable filename
    | MakeSafeClientOriginalName() will sanitize the string to be an acceptable label
    */
    UploadedFile::class => [
        'saveOnDisk' => \Fls\Macros\Macros\UploadedFile\SaveOnDisk::class,
    ],
];
