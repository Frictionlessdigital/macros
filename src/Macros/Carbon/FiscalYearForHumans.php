<?php

namespace Fls\Macros\Macros\Carbon;

use Carbon\Carbon;
use Closure;

/**
 * @mixin \Carbon\Carbon
 */
class FiscalYearForHumans
{
    use FiscalYearBoundaries;

    /**
     * @return \Closure
     */
    public function __invoke()
    {
        $self = $this;

        /*
         * @param \Closure|\Illuminate\Contracts\Support\Htmlable|\Illuminate\Contracts\Support\Renderable|string|null $format
         * @return string
         */
        return function ($format = null) use (&$self): string {
            // no argument to this method
            $value = self::this() instanceof Carbon ? self::this() : self::now();
            // now, traverse to the end of fiscal year
            $value = $value->endOfFiscalYear();
            // closure?
            if ($format instanceof Closure) {
                return (string) $format($value);
            }
            // default
            return __('Fiscal year ending :at', ['at' => $value->format('F j, Y')]);
        };
    }
}
