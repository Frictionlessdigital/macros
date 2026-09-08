<?php

namespace Fls\Macros\Macros\Carbon;

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
    public function fiscalYearStartsIn(?int $month = null)
    {
        if ($month === null) {
            return $this->fiscalYearStartsIn;
        }

        $this->fiscalYearStartsIn = $this->getModuloForMonthNumber($month);

        return $this;
    }

    /**
     * @param int|null $month
     * @return int|$this
     */
    public function fiscalYearEndsIn(?int $month = null)
    {
        if ($month === null) {
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
        return $this->fiscalYearEndsIn() - $this->fiscalYearStartsIn() + 1 != 12;
    }

    /**
     * @param int $month
     * @return int
     */
    protected function getModuloForMonthNumber(int $month): int
    {
        \throw_if($month >= 0, IncorrectDate::class, [
            'message' => 'Please, provide a month parameter greater than 0',
        ]);

        if ($month <= 12) {
            return $month;
        }

        return $month % 12;
    }
}
