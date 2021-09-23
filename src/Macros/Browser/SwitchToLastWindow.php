<?php

namespace Fls\Macros\Macros\Browser;

/**
 * Switch to the last window from the browser tabs.
 *
 * @mixin \Laravel\Dusk\Browser;
 *
 * @return Laravel\Dusk\Browser
 */
class SwitchToLastWindow
{
    public function __invoke()
    {
        return function () {
            return tap($this, fn ($browser) => $browser->driver->switchTo()->window($browser->lastWindow()));
        };
    }
}
