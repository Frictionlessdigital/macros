<?php

namespace Fls\Macros\Macros\Carbon;

use Carbon\Carbon;

/**
 * @mixin \Carbon\Carbon
 */
class EndOfFiscalYear
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
            if ($self->mayNeedToAdjustYearForFiscalYearCalculation() and $value->month > $self->fiscalYearEndsIn()) {
                // the difference in year is only needed if we are before the start of year
                // add one year
                $value->addYear();
            }
            // return
            return $value
                ->month($self->fiscalYearEndsIn())
                ->endOfMonth();
        };
    }
}
