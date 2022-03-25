<?php

namespace Fls\Macros\Macros\Carbon;

use Carbon\Carbon;
use function is_null;

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
         * @param \DateTimeInterface|\Carbon\Carbon|null $at
         * @return \Carbon\Carbon
         */
        return function ($at = null) use (&$self): Carbon {
            // parse argument
            $value = is_null($at) ? (self::this() instanceof Carbon ? self::this() : Carbon::now()) : Carbon::parse($at);
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
