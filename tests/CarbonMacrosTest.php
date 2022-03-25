<?php

namespace Fls\Macros\Tests;

use Carbon\Carbon;

class CarbonMacrosTest extends TestCase
{
    /** @return void */
    public function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow('March 25, 2022 5:20 PM');
    }

    /** @test */
    public function it_will_return_start_of_fiscal_year_when_before_april_1st(): void
    {
        $value = Carbon::parse('January 1, 2022')->startOfFiscalYear();

        $expected = Carbon::parse('April 1, 2021')->startOfDay();

        $this->assertTrue($expected->equalTo($value));
    }

    /** @test */
    public function it_will_return_start_for_current_year_before_april_1st(): void
    {
        // "now"
        $value = Carbon::startOfFiscalYear();

        $expected = Carbon::parse('April 1, 2021')->startOfDay();

        $this->assertTrue($expected->equalTo($value));
    }

    /** @test */
    public function it_will_handle_start_of_fiscal_year_for_dates_after_april_1st(): void
    {
        $value = Carbon::parse('April 2, 2022 8:00')->startOfFiscalYear();

        $expected = Carbon::parse('April 1, 2022')->startOfDay();

        $this->assertTrue($expected->equalTo($value));
    }

    /** @test */
    public function it_will_handle_end_of_fiscal_year_without_argument(): void
    {
        // "now"
        $value = Carbon::endOfFiscalYear();

        $expected = Carbon::parse('March 31, 2022')->endOfDay();

        $this->assertTrue($expected->equalTo($value));
    }

    /** @test */
    public function it_will_handle_end_of_fiscal_year_with_argument_before_april_1st(): void
    {
        // "now"
        $value = Carbon::parse('January 1, 2022')->endOfFiscalYear();

        $expected = Carbon::parse('March 31, 2022')->endOfDay();

        $this->assertTrue($expected->equalTo($value));
    }

    /** @test */
    public function it_will_handle_end_of_fiscal_year_with_argument_after_april_1st(): void
    {
        // "now"
        $value = Carbon::parse('April 2, 2022 8:00 AM')->endOfFiscalYear();

        $expected = Carbon::parse('March 31, 2023')->endOfDay();

        $this->assertTrue($expected->equalTo($value));
    }

    /** @test */
    public function it_will_handle_end_of_fiscal_year_with_argument_on_march_31st(): void
    {
        // "now"
        $value = Carbon::parse('March 31, 2023')->endOfDay()->endOfFiscalYear();

        $expected = Carbon::parse('March 31, 2023')->endOfDay();

        $this->assertTrue($expected->equalTo($value));
    }

    /**
     * @test
     * @dataProvider provides_valid_values_for_fiscal_year_check
     */
    public function it_will_handle_checking_for_fiscal_year($value): void
    {
        $this->assertFalse(Carbon::parse($value)->isFiscalYear(2021));
        $this->assertTrue(Carbon::parse($value)->isFiscalYear(2022));
        $this->assertFalse(Carbon::parse($value)->isFiscalYear(2023));
    }

    /**
     * provide data for the it_will_handle_checking_for_fiscal_year test.
     * @return array[]
     */
    public function provides_valid_values_for_fiscal_year_check()
    {
        return [
            [Carbon::now()],
            [Carbon::today()],
            [Carbon::parse('April 1, 2021')],
            [Carbon::parse('December 1, 2021')],
            [Carbon::parse('January 1, 2022')],
            [Carbon::parse('March 31, 2022')->endOfDay()],
        ];
    }
}
