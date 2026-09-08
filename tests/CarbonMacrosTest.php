<?php

namespace Fls\Macros\Tests;

use Carbon\Carbon;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class CarbonMacrosTest extends TestCase
{
    /** @return void */
    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow('March 25, 2022 5:20 PM');
    }

    #[Test]
    public function it_will_handle_the_start_of_fiscal_year_without_value_defaulting_to_now(): void
    {
        $expected = Carbon::parse('April 1, 2021')->startOfDay();
        $result = Carbon::startOfFiscalYear();

        $this->assertTrue($expected->equalTo($result));
    }

    #[Test]
    #[DataProvider('provides_valid_values_for_the_start_of_fiscal_year_test')]
    public function it_will_handle_the_start_of_fiscal_year($value): void
    {
        $expected = Carbon::parse('April 1, 2021')->startOfDay();
        $result = Carbon::parse($value)->startOfFiscalYear();

        $this->assertTrue($expected->equalTo($result));
    }

    public static function provides_valid_values_for_the_start_of_fiscal_year_test()
    {
        return [
            ['March 25, 2022 5:20 PM'],
            ['March 25, 2022'],
            [Carbon::parse('January 1, 2022')],
            [Carbon::parse('December 31, 2021')],
            [Carbon::parse('April 1, 2021')->startOfDay()],
            [Carbon::parse('March 31, 2022')->endOfDay()],
        ];
    }

    #[Test]
    public function it_will_handle_end_of_fiscal_year_without_argument_defaulting_to_now(): void
    {
        // "now"
        $result = Carbon::endOfFiscalYear();
        $expected = Carbon::parse('March 31, 2022')->endOfDay();

        $this->assertTrue($expected->equalTo($result));
    }

    #[Test]
    #[DataProvider('provides_valid_values_for_the_end_of_fiscal_year_test')]
    public function it_will_handle_end_of_fiscal_year($value): void
    {
        $result = Carbon::parse($value)->endOfFiscalYear();
        $expected = Carbon::parse('March 31, 2022')->endOfDay();

        $this->assertTrue($expected->equalTo($result));
    }

    public static function provides_valid_values_for_the_end_of_fiscal_year_test()
    {
        return [
            ['March 25, 2022 5:20 PM'],
            ['March 25, 2022'],
            [Carbon::parse('January 1, 2022')],
            [Carbon::parse('December 31, 2021')],
            [Carbon::parse('April 1, 2021')->startOfDay()],
            [Carbon::parse('March 31, 2022')->endOfDay()],
        ];
    }

    #[Test]
    #[DataProvider('provides_valid_values_for_fiscal_year_check')]
    public function it_will_handle_checking_for_fiscal_year($value): void
    {
        $this->assertFalse(Carbon::parse($value)->isFiscalYear(2021));
        $this->assertTrue(Carbon::parse($value)->isFiscalYear(2022));
        $this->assertFalse(Carbon::parse($value)->isFiscalYear(2023));
    }

    public static function provides_valid_values_for_fiscal_year_check()
    {
        return [
            ['March 25, 2022 5:20 PM'],
            ['March 25, 2022'],
            [Carbon::parse('April 1, 2021')],
            [Carbon::parse('December 1, 2021')],
            [Carbon::parse('January 1, 2022')],
            [Carbon::parse('March 31, 2022')->endOfDay()],
        ];
    }

    #[Test]
    public function it_will_handle_making_a_default_fiscal_year_for_humans(): void
    {
        $value = Carbon::fiscalYearForHumans();

        $this->assertEquals('Fiscal year ending March 31, 2022', $value);
    }

    #[Test]
    #[DataProvider('provides_valid_values_for_fiscal_year_for_humans')]
    public function it_will_handle_making_a_fiscal_year_for_humans_from_a_date($date): void
    {
        $value = Carbon::parse($date)->fiscalYearForHumans();

        $this->assertEquals('Fiscal year ending March 31, 2023', $value);
    }

    public static function provides_valid_values_for_fiscal_year_for_humans()
    {
        return [
            [Carbon::parse('April 1, 2022')],
            [Carbon::parse('December 1, 2022')],
            [Carbon::parse('January 1, 2023')],
            [Carbon::parse('March 31, 2023')->endOfDay()],
        ];
    }

    #[Test]
    public function it_will_handle_making_fiscal_year_for_humans_using_closure(): void
    {
        $value = Carbon::fiscalYearForHumans(fn ($value) => __('Foo Bar :on', ['on' => $value->format('l, F j, Y')]));

        $this->assertEquals('Foo Bar Thursday, March 31, 2022', $value);
    }
}
