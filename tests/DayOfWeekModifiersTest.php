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

class DayOfWeekModifiersTest extends TestFixture
{
    public function testStartOfWeek()
    {
        $d = IntlCarbon::create(1980, 8, 7, 12, 11, 9)->startOfWeek();
        $this->assertIntlCarbon($d, 1980, 8, 4, 0, 0, 0);
    }

    public function testStartOfWeekFromWeekStart()
    {
        $d = IntlCarbon::createFromDate(1980, 8, 4)->startOfWeek();
        $this->assertIntlCarbon($d, 1980, 8, 4, 0, 0, 0);
    }

    public function testStartOfWeekCrossingYearBoundary()
    {
        $d = IntlCarbon::createFromDate(2013, 12, 31, 'GMT');
        $d->startOfWeek();
        $this->assertIntlCarbon($d, 2013, 12, 30, 0, 0, 0);
    }

    public function testEndOfWeek()
    {
        $d = IntlCarbon::create(1980, 8, 7, 11, 12, 13)->endOfWeek();
        $this->assertIntlCarbon($d, 1980, 8, 10, 23, 59, 59);
    }

    public function testEndOfWeekFromWeekEnd()
    {
        $d = IntlCarbon::createFromDate(1980, 8, 9)->endOfWeek();
        $this->assertIntlCarbon($d, 1980, 8, 10, 23, 59, 59);
    }

    public function testEndOfWeekCrossingYearBoundary()
    {
        $d = IntlCarbon::createFromDate(2013, 12, 31, 'GMT');
        $d->endOfWeek();
        $this->assertIntlCarbon($d, 2014, 1, 5, 23, 59, 59);
    }

    public function testNext()
    {
        $d = IntlCarbon::createFromDate(1975, 5, 21)->next();
        $this->assertIntlCarbon($d, 1975, 5, 28, 0, 0, 0);
    }

    public function testNextMonday()
    {
        $d = IntlCarbon::createFromDate(1975, 5, 21)->next(IntlCarbon::MONDAY);
        $this->assertIntlCarbon($d, 1975, 5, 26, 0, 0, 0);
    }

    public function testNextSaturday()
    {
        $d = IntlCarbon::createFromDate(1975, 5, 21)->next(6);
        $this->assertIntlCarbon($d, 1975, 5, 24, 0, 0, 0);
    }

    public function testNextTimestamp()
    {
        $d = IntlCarbon::createFromDate(1975, 11, 14)->next();
        $this->assertIntlCarbon($d, 1975, 11, 21, 0, 0, 0);
    }

    public function testPrevious()
    {
        $d = IntlCarbon::createFromDate(1975, 5, 21)->previous();
        $this->assertIntlCarbon($d, 1975, 5, 14, 0, 0, 0);
    }

    public function testPreviousMonday()
    {
        $d = IntlCarbon::createFromDate(1975, 5, 21)->previous(IntlCarbon::MONDAY);
        $this->assertIntlCarbon($d, 1975, 5, 19, 0, 0, 0);
    }

    public function testPreviousSaturday()
    {
        $d = IntlCarbon::createFromDate(1975, 5, 21)->previous(6);
        $this->assertIntlCarbon($d, 1975, 5, 17, 0, 0, 0);
    }

    public function testPreviousTimestamp()
    {
        $d = IntlCarbon::createFromDate(1975, 11, 28)->previous();
        $this->assertIntlCarbon($d, 1975, 11, 21, 0, 0, 0);
    }

    public function testFirstDayOfMonth()
    {
        $d = IntlCarbon::createFromDate(1975, 11, 21)->firstOfMonth();
        $this->assertIntlCarbon($d, 1975, 11, 1, 0, 0, 0);
    }

    public function testFirstWednesdayOfMonth()
    {
        $d = IntlCarbon::createFromDate(1975, 11, 21)->firstOfMonth(IntlCarbon::WEDNESDAY);
        $this->assertIntlCarbon($d, 1975, 11, 5, 0, 0, 0);
    }

    public function testFirstFridayOfMonth()
    {
        $d = IntlCarbon::createFromDate(1975, 11, 21)->firstOfMonth(5);
        $this->assertIntlCarbon($d, 1975, 11, 7, 0, 0, 0);
    }

    public function testLastDayOfMonth()
    {
        $d = IntlCarbon::createFromDate(1975, 12, 5)->lastOfMonth();
        $this->assertIntlCarbon($d, 1975, 12, 31, 0, 0, 0);
    }

    public function testLastTuesdayOfMonth()
    {
        $d = IntlCarbon::createFromDate(1975, 12, 1)->lastOfMonth(IntlCarbon::TUESDAY);
        $this->assertIntlCarbon($d, 1975, 12, 30, 0, 0, 0);
    }

    public function testLastFridayOfMonth()
    {
        $d = IntlCarbon::createFromDate(1975, 12, 5)->lastOfMonth(5);
        $this->assertIntlCarbon($d, 1975, 12, 26, 0, 0, 0);
    }

    public function testNthOfMonthOutsideScope()
    {
        $this->assertFalse(IntlCarbon::createFromDate(1975, 12, 5)->nthOfMonth(6, IntlCarbon::MONDAY));
    }

    public function testNthOfMonthOutsideYear()
    {
        $this->assertFalse(IntlCarbon::createFromDate(1975, 12, 5)->nthOfMonth(55, IntlCarbon::MONDAY));
    }

    public function test2ndMondayOfMonth()
    {
        $d = IntlCarbon::createFromDate(1975, 12, 5)->nthOfMonth(2, IntlCarbon::MONDAY);
        $this->assertIntlCarbon($d, 1975, 12, 8, 0, 0, 0);
    }

    public function test3rdWednesdayOfMonth()
    {
        $d = IntlCarbon::createFromDate(1975, 12, 5)->nthOfMonth(3, 3);
        $this->assertIntlCarbon($d, 1975, 12, 17, 0, 0, 0);
    }

    public function testFirstDayOfQuarter()
    {
        $d = IntlCarbon::createFromDate(1975, 11, 21)->firstOfQuarter();
        $this->assertIntlCarbon($d, 1975, 10, 1, 0, 0, 0);
    }

    public function testFirstWednesdayOfQuarter()
    {
        $d = IntlCarbon::createFromDate(1975, 11, 21)->firstOfQuarter(IntlCarbon::WEDNESDAY);
        $this->assertIntlCarbon($d, 1975, 10, 1, 0, 0, 0);
    }

    public function testFirstFridayOfQuarter()
    {
        $d = IntlCarbon::createFromDate(1975, 11, 21)->firstOfQuarter(5);
        $this->assertIntlCarbon($d, 1975, 10, 3, 0, 0, 0);
    }

    public function testFirstOfQuarterFromADayThatWillNotExistIntheFirstMonth()
    {
        $d = IntlCarbon::createFromDate(2014, 5, 31)->firstOfQuarter();
        $this->assertIntlCarbon($d, 2014, 4, 1, 0, 0, 0);
    }

    public function testLastDayOfQuarter()
    {
        $d = IntlCarbon::createFromDate(1975, 8, 5)->lastOfQuarter();
        $this->assertIntlCarbon($d, 1975, 9, 30, 0, 0, 0);
    }

    public function testLastTuesdayOfQuarter()
    {
        $d = IntlCarbon::createFromDate(1975, 8, 1)->lastOfQuarter(IntlCarbon::TUESDAY);
        $this->assertIntlCarbon($d, 1975, 9, 30, 0, 0, 0);
    }

    public function testLastFridayOfQuarter()
    {
        $d = IntlCarbon::createFromDate(1975, 7, 5)->lastOfQuarter(5);
        $this->assertIntlCarbon($d, 1975, 9, 26, 0, 0, 0);
    }

    public function testLastOfQuarterFromADayThatWillNotExistIntheLastMonth()
    {
        $d = IntlCarbon::createFromDate(2014, 5, 31)->lastOfQuarter();
        $this->assertIntlCarbon($d, 2014, 6, 30, 0, 0, 0);
    }

    public function testNthOfQuarterOutsideScope()
    {
        $this->assertFalse(IntlCarbon::createFromDate(1975, 1, 5)->nthOfQuarter(20, IntlCarbon::MONDAY));
    }

    public function testNthOfQuarterOutsideYear()
    {
        $this->assertFalse(IntlCarbon::createFromDate(1975, 1, 5)->nthOfQuarter(55, IntlCarbon::MONDAY));
    }

    public function testNthOfQuarterFromADayThatWillNotExistIntheFirstMonth()
    {
        $d = IntlCarbon::createFromDate(2014, 5, 31)->nthOfQuarter(2, IntlCarbon::MONDAY);
        $this->assertIntlCarbon($d, 2014, 4, 14, 0, 0, 0);
    }

    public function test2ndMondayOfQuarter()
    {
        $d = IntlCarbon::createFromDate(1975, 8, 5)->nthOfQuarter(2, IntlCarbon::MONDAY);
        $this->assertIntlCarbon($d, 1975, 7, 14, 0, 0, 0);
    }

    public function test3rdWednesdayOfQuarter()
    {
        $d = IntlCarbon::createFromDate(1975, 8, 5)->nthOfQuarter(3, 3);
        $this->assertIntlCarbon($d, 1975, 7, 16, 0, 0, 0);
    }

    public function testFirstDayOfYear()
    {
        $d = IntlCarbon::createFromDate(1975, 11, 21)->firstOfYear();
        $this->assertIntlCarbon($d, 1975, 1, 1, 0, 0, 0);
    }

    public function testFirstWednesdayOfYear()
    {
        $d = IntlCarbon::createFromDate(1975, 11, 21)->firstOfYear(IntlCarbon::WEDNESDAY);
        $this->assertIntlCarbon($d, 1975, 1, 1, 0, 0, 0);
    }

    public function testFirstFridayOfYear()
    {
        $d = IntlCarbon::createFromDate(1975, 11, 21)->firstOfYear(5);
        $this->assertIntlCarbon($d, 1975, 1, 3, 0, 0, 0);
    }

    public function testLastDayOfYear()
    {
        $d = IntlCarbon::createFromDate(1975, 8, 5)->lastOfYear();
        $this->assertIntlCarbon($d, 1975, 12, 31, 0, 0, 0);
    }

    public function testLastTuesdayOfYear()
    {
        $d = IntlCarbon::createFromDate(1975, 8, 1)->lastOfYear(IntlCarbon::TUESDAY);
        $this->assertIntlCarbon($d, 1975, 12, 30, 0, 0, 0);
    }

    public function testLastFridayOfYear()
    {
        $d = IntlCarbon::createFromDate(1975, 7, 5)->lastOfYear(5);
        $this->assertIntlCarbon($d, 1975, 12, 26, 0, 0, 0);
    }

    public function testNthOfYearOutsideScope()
    {
        $this->assertFalse(IntlCarbon::createFromDate(1975, 1, 5)->nthOfYear(55, IntlCarbon::MONDAY));
    }

    public function test2ndMondayOfYear()
    {
        $d = IntlCarbon::createFromDate(1975, 8, 5)->nthOfYear(2, IntlCarbon::MONDAY);
        $this->assertIntlCarbon($d, 1975, 1, 13, 0, 0, 0);
    }

    public function test3rdWednesdayOfYear()
    {
        $d = IntlCarbon::createFromDate(1975, 8, 5)->nthOfYear(3, 3);
        $this->assertIntlCarbon($d, 1975, 1, 15, 0, 0, 0);
    }
}
