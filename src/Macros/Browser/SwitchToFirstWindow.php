<?php

namespace Fls\Macros\Macros\Browser;

/**
 * Switch to the first window from the browser tabs.
 *
 * @mixin \Laravel\Dusk\Browser;
 *
 * @return Laravel\Dusk\Browser
 */
class SwitchToFirstWindow
{
    public function __invoke()
    {
        return function () {
            return tap($this, fn ($browser) => $browser->driver->switchTo()->window($browser->firstWindow()));
        };
    }
}
