<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use IntlCarbon\IntlCarbon;

class StartEndOfTest extends TestFixture
{
    public function testStartOfDay()
    {
        $dt = IntlCarbon::now();
        $this->assertTrue($dt->startOfDay() instanceof IntlCarbon);
        $this->assertIntlCarbon($dt, $dt->year, $dt->month, $dt->day, 0, 0, 0);
    }

    public function testEndOfDay()
    {
        $dt = IntlCarbon::now();
        $this->assertTrue($dt->endOfDay() instanceof IntlCarbon);
        $this->assertIntlCarbon($dt, $dt->year, $dt->month, $dt->day, 23, 59, 59);
    }

    public function testStartOfMonthIsFluid()
    {
        $dt = IntlCarbon::now();
        $this->assertTrue($dt->startOfMonth() instanceof IntlCarbon);
    }

    public function testStartOfMonthFromNow()
    {
        $dt = IntlCarbon::now()->startOfMonth();
        $this->assertIntlCarbon($dt, $dt->year, $dt->month, 1, 0, 0, 0);
    }

    public function testStartOfMonthFromLastDay()
    {
        $dt = IntlCarbon::create(2000, 1, 31, 2, 3, 4)->startOfMonth();
        $this->assertIntlCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testStartOfYearIsFluid()
    {
        $dt = IntlCarbon::now();
        $this->assertTrue($dt->startOfYear() instanceof IntlCarbon);
    }

    public function testStartOfYearFromNow()
    {
        $dt = IntlCarbon::now()->startOfYear();
        $this->assertIntlCarbon($dt, $dt->year, 1, 1, 0, 0, 0);
    }

    public function testStartOfYearFromFirstDay()
    {
        $dt = IntlCarbon::create(2000, 1, 1, 1, 1, 1)->startOfYear();
        $this->assertIntlCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testStartOfYearFromLastDay()
    {
        $dt = IntlCarbon::create(2000, 12, 31, 23, 59, 59)->startOfYear();
        $this->assertIntlCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testEndOfMonthIsFluid()
    {
        $dt = IntlCarbon::now();
        $this->assertTrue($dt->endOfMonth() instanceof IntlCarbon);
    }

    public function testEndOfMonth()
    {
        $dt = IntlCarbon::create(2000, 1, 1, 2, 3, 4)->endOfMonth();
        $this->assertIntlCarbon($dt, 2000, 1, 31, 23, 59, 59);
    }

    public function testEndOfMonthFromLastDay()
    {
        $dt = IntlCarbon::create(2000, 1, 31, 2, 3, 4)->endOfMonth();
        $this->assertIntlCarbon($dt, 2000, 1, 31, 23, 59, 59);
    }

    public function testEndOfYearIsFluid()
    {
        $dt = IntlCarbon::now();
        $this->assertTrue($dt->endOfYear() instanceof IntlCarbon);
    }

    public function testEndOfYearFromNow()
    {
        $dt = IntlCarbon::now()->endOfYear();
        $this->assertIntlCarbon($dt, $dt->year, 12, 31, 23, 59, 59);
    }

    public function testEndOfYearFromFirstDay()
    {
        $dt = IntlCarbon::create(2000, 1, 1, 1, 1, 1)->endOfYear();
        $this->assertIntlCarbon($dt, 2000, 12, 31, 23, 59, 59);
    }

    public function testEndOfYearFromLastDay()
    {
        $dt = IntlCarbon::create(2000, 12, 31, 23, 59, 59)->endOfYear();
        $this->assertIntlCarbon($dt, 2000, 12, 31, 23, 59, 59);
    }

    public function testStartOfDecadeIsFluid()
    {
        $dt = IntlCarbon::now();
        $this->assertTrue($dt->startOfDecade() instanceof IntlCarbon);
    }

    public function testStartOfDecadeFromNow()
    {
        $dt = IntlCarbon::now()->startOfDecade();
        $this->assertIntlCarbon($dt, $dt->year - $dt->year % 10, 1, 1, 0, 0, 0);
    }

    public function testStartOfDecadeFromFirstDay()
    {
        $dt = IntlCarbon::create(2000, 1, 1, 1, 1, 1)->startOfDecade();
        $this->assertIntlCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testStartOfDecadeFromLastDay()
    {
        $dt = IntlCarbon::create(2009, 12, 31, 23, 59, 59)->startOfDecade();
        $this->assertIntlCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testEndOfDecadeIsFluid()
    {
        $dt = IntlCarbon::now();
        $this->assertTrue($dt->endOfDecade() instanceof IntlCarbon);
    }

    public function testEndOfDecadeFromNow()
    {
        $dt = IntlCarbon::now()->endOfDecade();
        $this->assertIntlCarbon($dt, $dt->year - $dt->year % 10 + 9, 12, 31, 23, 59, 59);
    }

    public function testEndOfDecadeFromFirstDay()
    {
        $dt = IntlCarbon::create(2000, 1, 1, 1, 1, 1)->endOfDecade();
        $this->assertIntlCarbon($dt, 2009, 12, 31, 23, 59, 59);
    }

    public function testEndOfDecadeFromLastDay()
    {
        $dt = IntlCarbon::create(2009, 12, 31, 23, 59, 59)->endOfDecade();
        $this->assertIntlCarbon($dt, 2009, 12, 31, 23, 59, 59);
    }

    public function testStartOfCenturyIsFluid()
    {
        $dt = IntlCarbon::now();
        $this->assertTrue($dt->startOfCentury() instanceof IntlCarbon);
    }

    public function testStartOfCenturyFromNow()
    {
        $dt = IntlCarbon::now()->startOfCentury();
        $this->assertIntlCarbon($dt, $dt->year - $dt->year % 100, 1, 1, 0, 0, 0);
    }

    public function testStartOfCenturyFromFirstDay()
    {
        $dt = IntlCarbon::create(2000, 1, 1, 1, 1, 1)->startOfCentury();
        $this->assertIntlCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testStartOfCenturyFromLastDay()
    {
        $dt = IntlCarbon::create(2009, 12, 31, 23, 59, 59)->startOfCentury();
        $this->assertIntlCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testEndOfCenturyIsFluid()
    {
        $dt = IntlCarbon::now();
        $this->assertTrue($dt->endOfCentury() instanceof IntlCarbon);
    }

    public function testEndOfCenturyFromNow()
    {
        $dt = IntlCarbon::now()->endOfCentury();
        $this->assertIntlCarbon($dt, $dt->year - $dt->year % 100 + 99, 12, 31, 23, 59, 59);
    }

    public function testEndOfCenturyFromFirstDay()
    {
        $dt = IntlCarbon::create(2000, 1, 1, 1, 1, 1)->endOfCentury();
        $this->assertIntlCarbon($dt, 2099, 12, 31, 23, 59, 59);
    }

    public function testEndOfCenturyFromLastDay()
    {
        $dt = IntlCarbon::create(2099, 12, 31, 23, 59, 59)->endOfCentury();
        $this->assertIntlCarbon($dt, 2099, 12, 31, 23, 59, 59);
    }

    public function testAverageIsFluid()
    {
        $dt = IntlCarbon::now()->average();
        $this->assertTrue($dt instanceof IntlCarbon);
    }

    public function testAverageFromSame()
    {
        $dt1 = IntlCarbon::create(2000, 1, 31, 2, 3, 4);
        $dt2 = IntlCarbon::create(2000, 1, 31, 2, 3, 4)->average($dt1);
        $this->assertIntlCarbon($dt2, 2000, 1, 31, 2, 3, 4);
    }

    public function testAverageFromGreater()
    {
        $dt1 = IntlCarbon::create(2000, 1, 1, 1, 1, 1);
        $dt2 = IntlCarbon::create(2009, 12, 31, 23, 59, 59)->average($dt1);
        $this->assertIntlCarbon($dt2, 2004, 12, 31, 12, 30, 30);
    }

    public function testAverageFromLower()
    {
        $dt1 = IntlCarbon::create(2009, 12, 31, 23, 59, 59);
        $dt2 = IntlCarbon::create(2000, 1, 1, 1, 1, 1)->average($dt1);
        $this->assertIntlCarbon($dt2, 2004, 12, 31, 12, 30, 30);
    }
}
