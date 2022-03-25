<?php

namespace Fls\Macros\Macros\Carbon;

use Carbon\Carbon;

/**
 * @mixin \Carbon\Carbon
 */
class IsFiscalYear
{
    use FiscalYearBoundaries;

    /**
     * @return \Closure
     */
    public function __invoke()
    {
        $self = $this;
        /*
         * @param int $year
         * @return bool
         */
        return function (int $year) use (&$self): bool {
            // resolve value
            $value = self::this() instanceof Carbon ? self::this() : self::now();
            // now we need to decide, if the month of the value is greater than starting month of the fiscal year
            if (! $self->mayNeedToAdjustYearForFiscalYearCalculation()) {
                return $year === $value->year;
            }

            if ($value->month <= $self->fiscalYearEndsIn()) {
                return $year === $value->year;
            }

            return ($year - 1) === $value->year;
        };
    }
}
