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
         * @param \Closure|\Illuminate\Contracts\Support\Htmlable|\Illuminate\Contracts\Support\Renderable|string|null $formatter
         * @return mixed
         */
        return function ($formatter = null) use (&$self) {
            // no argument to this method
            $value = self::this() instanceof Carbon ? self::this() : self::now();
            // now, traverse to the end of fiscal year
            $value = $value->endOfFiscalYear();
            // closure?
            if ($formatter instanceof \Closure) {
                return $formatter($value);
            }
            // default
            return __('Fiscal year ending :at', ['at' => $value->format('F j, Y')]);
        };
    }
}
