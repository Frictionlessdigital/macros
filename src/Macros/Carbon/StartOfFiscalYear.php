<?php

namespace Fls\Macros\Macros\Carbon;

use Carbon\Carbon;

/**
 * @mixin \Carbon\Carbon
 */
class StartOfFiscalYear
{
    use FiscalYearBoundaries;

    /**
     * @return \Closure
     */
    public function __invoke()
    {
        $self = $this;

        /*
         * @return \Carbon\Carbon
         */
        return function () use (&$self): Carbon {
            // parse argument
            $value = self::this() instanceof Carbon ? self::this() : self::now();
            // adjust the clock, if set up needs it
            if ($self->mayNeedToAdjustYearForFiscalYearCalculation() and $value->month < $self->fiscalYearStartsIn()) {
                // the difference in year is only needed if we are before the start of year
                // sub one year
                $value->subYear();
            }
            // firstm rewind to start of month to avoid spill-overs
            return $value
                ->startOfMonth()
                ->month($self->fiscalYearStartsIn());
        };
    }
}
