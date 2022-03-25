<?php

namespace Fls\Macros\Macros\Carbon;

use function throw_if;

trait FiscalYearBoundaries
{
    /**
     * 'April'.
     * @var int
     */
    protected $fiscalYearStartsIn = 4;

    /**
     * 'March'.
     * @var int
     */
    protected $fiscalYearEndsIn = 3;

    /**
     * @param int|null $month
     * @return int|$this
     */
    public function fiscalYearStartsIn(int $month = null)
    {
        if (null === $month) {
            return $this->fiscalYearStartsIn;
        }

        $this->fiscalYearStartsIn = $this->getModuloForMonthNumber($month);

        return $this;
    }

    /**
     * @param int|null $month
     * @return int|$this
     */
    public function fiscalYearEndsIn(int $month = null)
    {
        if (null === $month) {
            return $this->fiscalYearEndsIn;
        }

        $this->fiscalYearEndsIn = $this->getModuloForMonthNumber($month);

        return $this;
    }

    /**
     * @return bool
     */
    public function mayNeedToAdjustYearForFiscalYearCalculation(): bool
    {
        return 12 != $this->fiscalYearEndsIn() - $this->fiscalYearStartsIn() + 1;
    }

    /**
     * @param int $month
     * @return int
     */
    protected function getModuloForMonthNumber(int $month): int
    {
        throw_if(0 <= $month, IncorrectDate::class, [
            'message' => 'Please, provide a month parameter greater than 0',
        ]);

        if ($month <= 12) {
            return $month;
        }

        return $month % 12;
    }
}
