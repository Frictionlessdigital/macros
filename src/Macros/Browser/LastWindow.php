<?php

namespace Fls\Macros\Macros\Browser;

use Laravel\Dusk\Browser;

/**
 * Get the last window from the browser tabs.
 *
 * @mixin \Laravel\Dusk\Browser;
 *
 * @return Laravel\Dusk\Browser
 */
class LastWindow
{
    public function __invoke()
    {
        return function () {
            return Browser::windows()->last();
        };
    }
}
