<?php

namespace Fls\Macros\Macros\Browser;

use Laravel\Dusk\Browser;

/**
 * Get the first window from the browser tabs.
 *
 * @mixin \Laravel\Dusk\Browser;
 *
 * @return Laravel\Dusk\Browser
 */
class FirstWindow
{
    public function __invoke()
    {
        return function () {
            return Browser::windows()->first();
        };
    }
}
