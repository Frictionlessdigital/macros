<?php

namespace Fls\Macros\Macros\Browser;

/**
 * Add Tenant field to the Blueprint.
 *
 * @mixin \Laravel\Dusk\Browser;
 *
 * @return Illuminate\Support\Collection
 */
class Windows
{
    public function __invoke()
    {
        return function () {
            return collect($this->driver->getWindowHandles());
        };
    }
}
