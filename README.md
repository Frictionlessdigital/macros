# FLS :: Macros

Ass some common macroses that Frictionless uses in their daily life.

## Installation

```bash
composer require "frictionlessdigital/macros":"^1.0"
```

Note that root namespace for the package is `Fls` not `Frictionlessdigital`.

### Config

To publish configuration file, run

THe package will publish `fls.macros.php` file:
```php
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
```

Configuration structure is simple: root key is the name of the class you need to add the macro to
and the array is the macros that are being added.

You will notice that some are commented out: the package does not insist you have those, and does tno silently pull them, to avoid surprises (with Dusk, for instance). As there is no need to pull extra packages when you dont need them - you should integrate them within your repo.

The list of packages is suggested in `composer.json`:

* [coduo/php-humanizer](https://github.com/coduo/php-humanizer) - Humanize values
* [laravel/dusk](https://github.com/laravel/dusk) - Laravel Testing tool

## Integration

The package automatically registers with Laravel.

If you want to manually register it, add to your `composer.json`:
```json
    "extra": {
        "laravel": {
            "dont-discover": [
                "frictionlessdigital/macros"
            ]
        }
    },
```
and add to `config\app.php`:
```php
    'providers' => [
        /*
         * Package Service Providers...
         */
        Fls\Macros\MacrosServiceProvider::class,
```

## Usage

The package offers extension for Builder, Carbon, Router, Collection and Dusk Browser.

### \Carbon\Carbon Macros

**fiscalYearForHumans($formatter=null)**
will get readable representation for the fiscal year. 
```php
$x = Carbon::now()->fiscalYearForHumans()
// $x = 'Fiscal year ending March 31, 2022'; 
```
`fiscalYearForHumans` accepts closure formatter:
```php
$x = Carbon::now()->fiscalYearForHumans(fn($at) => new HtmlString('<b>'.$at->year.'</b>'));
// $x = HtmlString('<b>2022</b>'); 
```

**startOfFiscalYear**
will modify the date to the start of the fiscal year
```php
Carbon::startOfFiscalYear();
// Carbon instance at April 1, 2021 0:0:0; 
```

**endOfFiscalYear**
will modify the date to the end of the fiscal year
```php
Carbon::endOfFiscalYear();
// Carbon instance at March 31, 2022 25:59:59; 
```

**isFiscalYear** 
Will check if the date is within the provided (int) fiscal year
```php
// assuming now is 
Carbon::parse('March 31, 2022')->isFiscalYear(2021);
// true
Carbon::parse('April 1, 2022')->isFiscalYear(2021);
// false
```

### Laravel\Dusk\Browser Macros
\*Requires Laravel Dusk:

```bash
composer require laravel/dusk
```

* firstWindow() - to get the first window
* lastWindow() - to get the last window
* switchToFirstWindow() - switch Browser to the first window
* switchTolastWindow() - switch Browser to the last window
* windows() - get all current Browser windows

### Illuminate\Database\Eloquent\Builder Macros

* toSqlWithBindings - get the SQL from the builder, hydrated with values

### Illuminate\Support\Collection Macros
Optionally, many need Coduo Humanizer, tested with version 4

```bash
composer require coduo/php-humanizer
```
* oxford - list values with Ofxord coma.

### Illuminate\Database\Eloquent\Factories\Factory Macros

* empty() - will return a Factory where every value in definition is `null`

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email support@frictionlesssolutions.com instead of using the issue tracker.

## Credits

- [Cyrill N Kalita][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://github.com/nickfls
[link-contributors]: ../../contributors

___

<p align="center"><a href="http://frictionlesssolutions.com" title="Fricitonless Solutions Inc."><img src="./resources/docs/gramma.png"></a></p>
