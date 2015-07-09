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
use Carbon\CarbonInterval;

class DiffTest extends TestFixture
{
    public function testDiffInYearsPositive()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInYears($dt->copy()->addYear()));
    }

    public function testDiffInYearsNegativeWithSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(-1, $dt->diffInYears($dt->copy()->subYear(), false));
    }

    public function testDiffInYearsNegativeNoSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInYears($dt->copy()->subYear()));
    }

    public function testDiffInYearsVsDefaultNow()
    {
        $this->assertSame(1, IntlCarbon::now()->subYear()->diffInYears());
    }

    public function testDiffInYearsEnsureIsTruncated()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInYears($dt->copy()->addYear()->addMonths(7)));
    }

    public function testDiffInMonthsPositive()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(13, $dt->diffInMonths($dt->copy()->addYear()->addMonth()));
    }

    public function testDiffInMonthsNegativeWithSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(-11, $dt->diffInMonths($dt->copy()->subYear()->addMonth(), false));
    }

    public function testDiffInMonthsNegativeNoSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(11, $dt->diffInMonths($dt->copy()->subYear()->addMonth()));
    }

    public function testDiffInMonthsVsDefaultNow()
    {
        $this->assertSame(12, IntlCarbon::now()->subYear()->diffInMonths());
    }

    public function testDiffInMonthsEnsureIsTruncated()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInMonths($dt->copy()->addMonth()->addDays(16)));
    }

    public function testDiffInDaysPositive()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(366, $dt->diffInDays($dt->copy()->addYear()));
    }

    public function testDiffInDaysNegativeWithSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(-365, $dt->diffInDays($dt->copy()->subYear(), false));
    }

    public function testDiffInDaysNegativeNoSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(365, $dt->diffInDays($dt->copy()->subYear()));
    }

    public function testDiffInDaysVsDefaultNow()
    {
        $this->assertSame(7, IntlCarbon::now()->subWeek()->diffInDays());
    }

    public function testDiffInDaysEnsureIsTruncated()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInDays($dt->copy()->addDay()->addHours(13)));
    }

    public function testDiffInDaysFilteredPositiveWithMutated()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(5, $dt->diffInDaysFiltered(function (IntlCarbon $date) {
            return $date->dayOfWeek === 1;
        }, $dt->copy()->endOfMonth()));
    }

    public function testDiffInDaysFilteredPositiveWithSecondObject()
    {
        $dt1 = IntlCarbon::createFromDate(2000, 1, 1);
        $dt2 = IntlCarbon::createFromDate(2000, 1, 31);

        $this->assertSame(5, $dt1->diffInDaysFiltered(function (IntlCarbon $date) {
            return $date->dayOfWeek === IntlCarbon::SUNDAY;
        }, $dt2));
    }

    public function testDiffInDaysFilteredNegativeNoSignWithMutated()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 31);
        $this->assertSame(5, $dt->diffInDaysFiltered(function (IntlCarbon $date) {
            return $date->dayOfWeek === IntlCarbon::SUNDAY;
        }, $dt->copy()->startOfMonth()));
    }

    public function testDiffInDaysFilteredNegativeNoSignWithSecondObject()
    {
        $dt1 = IntlCarbon::createFromDate(2000, 1, 31);
        $dt2 = IntlCarbon::createFromDate(2000, 1, 1);

        $this->assertSame(5, $dt1->diffInDaysFiltered(function (IntlCarbon $date) {
            return $date->dayOfWeek === IntlCarbon::SUNDAY;
        }, $dt2));
    }

    public function testDiffInDaysFilteredNegativeWithSignWithMutated()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 31);
        $this->assertSame(-5, $dt->diffInDaysFiltered(function (IntlCarbon $date) {
            return $date->dayOfWeek === 1;
        }, $dt->copy()->startOfMonth(), false));
    }

    public function testDiffInDaysFilteredNegativeWithSignWithSecondObject()
    {
        $dt1 = IntlCarbon::createFromDate(2000, 1, 31);
        $dt2 = IntlCarbon::createFromDate(2000, 1, 1);

        $this->assertSame(-5, $dt1->diffInDaysFiltered(function (IntlCarbon $date) {
            return $date->dayOfWeek === IntlCarbon::SUNDAY;
        }, $dt2, false));
    }

    public function testDiffInHoursFiltered()
    {
        $dt1 = IntlCarbon::createFromDate(2000, 1, 31)->endOfDay();
        $dt2 = IntlCarbon::createFromDate(2000, 1, 1)->startOfDay();

        $this->assertSame(31, $dt1->diffInHoursFiltered(function (IntlCarbon $date)
        {
            return $date->hour === 9;
        }, $dt2));
    }

    public function testDiffInHoursFilteredNegative()
    {
        $dt1 = IntlCarbon::createFromDate(2000, 1, 31)->endOfDay();
        $dt2 = IntlCarbon::createFromDate(2000, 1, 1)->startOfDay();

        $this->assertSame(-31, $dt1->diffInHoursFiltered(function (IntlCarbon $date)
        {
            return $date->hour === 9;
        }, $dt2, false));
    }

    public function testDiffInHoursFilteredWorkHoursPerWeek()
    {
        $dt1 = IntlCarbon::createFromDate(2000, 1, 5)->endOfDay();
        $dt2 = IntlCarbon::createFromDate(2000, 1, 1)->startOfDay();

        $this->assertSame(40, $dt1->diffInHoursFiltered(function (IntlCarbon $date)
        {
            return ($date->hour > 8 && $date->hour < 17);
        }, $dt2));
    }

    public function testDiffFilteredUsingMinutesPositiveWithMutated()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1)->startOfDay();
        $this->assertSame(60, $dt->diffFiltered(CarbonInterval::minute(), function (IntlCarbon $date) {
            return $date->hour === 12;
        }, IntlCarbon::createFromDate(2000, 1, 1)->endOfDay()));
    }

    public function testDiffFilteredPositiveWithSecondObject()
    {
        $dt1 = IntlCarbon::create(2000, 1, 1);
        $dt2 = $dt1->copy()->addSeconds(80);

        $this->assertSame(40, $dt1->diffFiltered(CarbonInterval::second(), function (IntlCarbon $date) {
            return $date->second % 2 === 0;
        }, $dt2));
    }

    public function testDiffFilteredNegativeNoSignWithMutated()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 31);

        $this->assertSame(2, $dt->diffFiltered(CarbonInterval::days(2), function (IntlCarbon $date) {
            return $date->dayOfWeek === IntlCarbon::SUNDAY;
        }, $dt->copy()->startOfMonth()));
    }

    public function testDiffFilteredNegativeNoSignWithSecondObject()
    {
        $dt1 = IntlCarbon::createFromDate(2006, 1, 31);
        $dt2 = IntlCarbon::createFromDate(2000, 1, 1);

        $this->assertSame(7, $dt1->diffFiltered(CarbonInterval::year(), function (IntlCarbon $date) {
            return $date->month === 1;
        }, $dt2));
    }

    public function testDiffFilteredNegativeWithSignWithMutated()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 31);
        $this->assertSame(-4, $dt->diffFiltered(CarbonInterval::week(), function (IntlCarbon $date) {
            return $date->month === 12;
        }, $dt->copy()->subMonths(3), false));
    }

    public function testDiffFilteredNegativeWithSignWithSecondObject()
    {
        $dt1 = IntlCarbon::createFromDate(2001, 1, 31);
        $dt2 = IntlCarbon::createFromDate(1999, 1, 1);

        $this->assertSame(-12, $dt1->diffFiltered(CarbonInterval::month(), function (IntlCarbon $date) {
            return $date->year === 2000;
        }, $dt2, false));
    }

    public function testBug188DiffWithSameDates()
    {
        $start = IntlCarbon::create(2014, 10, 8, 15, 20, 0);
        $end = $start->copy();

        $this->assertSame(0, $start->diffInDays($end));
        $this->assertSame(0, $start->diffInWeekdays($end));
    }

    public function testBug188DiffWithDatesOnlyHoursApart()
    {
        $start = IntlCarbon::create(2014, 10, 8, 15, 20, 0);
        $end = $start->copy();

        $this->assertSame(0, $start->diffInDays($end));
        $this->assertSame(0, $start->diffInWeekdays($end));
    }

    public function testBug188DiffWithSameDates1DayApart()
    {
        $start = IntlCarbon::create(2014, 10, 8, 15, 20, 0);
        $end = $start->copy()->addDay();

        $this->assertSame(1, $start->diffInDays($end));
        $this->assertSame(1, $start->diffInWeekdays($end));
    }

    public function testBug188DiffWithDatesOnTheWeekend()
    {
        $start = IntlCarbon::create(2014, 1, 1, 0, 0, 0);
        $start->next(IntlCarbon::SATURDAY);
        $end = $start->copy()->addDay();

        $this->assertSame(1, $start->diffInDays($end));
        $this->assertSame(0, $start->diffInWeekdays($end));
    }

    public function testDiffInWeekdaysPositive()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(21, $dt->diffInWeekdays($dt->copy()->endOfMonth()));
    }

    public function testDiffInWeekdaysNegativeNoSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 31);
        $this->assertSame(21, $dt->diffInWeekdays($dt->copy()->startOfMonth()));
    }

    public function testDiffInWeekdaysNegativeWithSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 31);
        $this->assertSame(-21, $dt->diffInWeekdays($dt->copy()->startOfMonth(), false));
    }

    public function testDiffInWeekendDaysPositive()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(10, $dt->diffInWeekendDays($dt->copy()->endOfMonth()));
    }

    public function testDiffInWeekendDaysNegativeNoSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 31);
        $this->assertSame(10, $dt->diffInWeekendDays($dt->copy()->startOfMonth()));
    }

    public function testDiffInWeekendDaysNegativeWithSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 31);
        $this->assertSame(-10, $dt->diffInWeekendDays($dt->copy()->startOfMonth(), false));
    }

    public function testDiffInWeeksPositive()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(52, $dt->diffInWeeks($dt->copy()->addYear()));
    }

    public function testDiffInWeeksNegativeWithSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(-52, $dt->diffInWeeks($dt->copy()->subYear(), false));
    }

    public function testDiffInWeeksNegativeNoSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(52, $dt->diffInWeeks($dt->copy()->subYear()));
    }

    public function testDiffInWeeksVsDefaultNow()
    {
        $this->assertSame(1, IntlCarbon::now()->subWeek()->diffInWeeks());
    }

    public function testDiffInWeeksEnsureIsTruncated()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(0, $dt->diffInWeeks($dt->copy()->addWeek()->subDay()));
    }

    public function testDiffInHoursPositive()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(26, $dt->diffInHours($dt->copy()->addDay()->addHours(2)));
    }

    public function testDiffInHoursNegativeWithSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(-22, $dt->diffInHours($dt->copy()->subDay()->addHours(2), false));
    }

    public function testDiffInHoursNegativeNoSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(22, $dt->diffInHours($dt->copy()->subDay()->addHours(2)));
    }

    public function testDiffInHoursVsDefaultNow()
    {
        IntlCarbon::setTestNow(IntlCarbon::create(2012, 1, 15));
        $this->assertSame(48, IntlCarbon::now()->subDays(2)->diffInHours());
        IntlCarbon::setTestNow();
    }

    public function testDiffInHoursEnsureIsTruncated()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInHours($dt->copy()->addHour()->addMinutes(31)));
    }

    public function testDiffInMinutesPositive()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(62, $dt->diffInMinutes($dt->copy()->addHour()->addMinutes(2)));
    }

    public function testDiffInMinutesPositiveAlot()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(1502, $dt->diffInMinutes($dt->copy()->addHours(25)->addMinutes(2)));
    }

    public function testDiffInMinutesNegativeWithSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(-58, $dt->diffInMinutes($dt->copy()->subHour()->addMinutes(2), false));
    }

    public function testDiffInMinutesNegativeNoSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(58, $dt->diffInMinutes($dt->copy()->subHour()->addMinutes(2)));
    }

    public function testDiffInMinutesVsDefaultNow()
    {
        $this->assertSame(60, IntlCarbon::now()->subHour()->diffInMinutes());
    }

    public function testDiffInMinutesEnsureIsTruncated()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInMinutes($dt->copy()->addMinute()->addSeconds(31)));
    }

    public function testDiffInSecondsPositive()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(62, $dt->diffInSeconds($dt->copy()->addMinute()->addSeconds(2)));
    }

    public function testDiffInSecondsPositiveAlot()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(7202, $dt->diffInSeconds($dt->copy()->addHours(2)->addSeconds(2)));
    }

    public function testDiffInSecondsNegativeWithSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(-58, $dt->diffInSeconds($dt->copy()->subMinute()->addSeconds(2), false));
    }

    public function testDiffInSecondsNegativeNoSign()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(58, $dt->diffInSeconds($dt->copy()->subMinute()->addSeconds(2)));
    }

    public function testDiffInSecondsVsDefaultNow()
    {
        $this->assertSame(3600, IntlCarbon::now()->subHour()->diffInSeconds());
    }

    public function testDiffInSecondsEnsureIsTruncated()
    {
        $dt = IntlCarbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInSeconds($dt->copy()->addSeconds(1.9)));
    }

    public function testDiffInSecondsWithTimezones()
    {
        $dtOttawa = IntlCarbon::createFromDate(2000, 1, 1, 'America/Toronto');
        $dtVancouver = IntlCarbon::createFromDate(2000, 1, 1, 'America/Vancouver');
        $this->assertSame(3 * 60 * 60, $dtOttawa->diffInSeconds($dtVancouver));
    }

    public function testDiffInSecondsWithTimezonesAndVsDefault()
    {
        $dt = IntlCarbon::now('America/Vancouver');
        $this->assertSame(0, $dt->diffInSeconds());
    }

    public function testDiffForHumansNowAndSecond()
    {
        $d = IntlCarbon::now();
        $this->assertSame('1 second ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndSecondWithTimezone()
    {
        $d = IntlCarbon::now('America/Vancouver');
        $this->assertSame('1 second ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndSeconds()
    {
        $d = IntlCarbon::now()->subSeconds(2);
        $this->assertSame('2 seconds ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndNearlyMinute()
    {
        $d = IntlCarbon::now()->subSeconds(59);
        $this->assertSame('59 seconds ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndMinute()
    {
        $d = IntlCarbon::now()->subMinute();
        $this->assertSame('1 minute ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndMinutes()
    {
        $d = IntlCarbon::now()->subMinutes(2);
        $this->assertSame('2 minutes ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndNearlyHour()
    {
        $d = IntlCarbon::now()->subMinutes(59);
        $this->assertSame('59 minutes ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndHour()
    {
        $d = IntlCarbon::now()->subHour();
        $this->assertSame('1 hour ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndHours()
    {
        IntlCarbon::setTestNow(IntlCarbon::create(2012, 1, 15));
        $d = IntlCarbon::now()->subHours(2);
        $this->assertSame('2 hours ago', $d->diffForHumans());
        IntlCarbon::setTestNow();
    }

    public function testDiffForHumansNowAndNearlyDay()
    {
        IntlCarbon::setTestNow(IntlCarbon::create(2012, 1, 15));
        $d = IntlCarbon::now()->subHours(23);
        $this->assertSame('23 hours ago', $d->diffForHumans());
        IntlCarbon::setTestNow();
    }

    public function testDiffForHumansNowAndDay()
    {
        $d = IntlCarbon::now()->subDay();
        $this->assertSame('1 day ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndDays()
    {
        $d = IntlCarbon::now()->subDays(2);
        $this->assertSame('2 days ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndNearlyWeek()
    {
        $d = IntlCarbon::now()->subDays(6);
        $this->assertSame('6 days ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndWeek()
    {
        $d = IntlCarbon::now()->subWeek();
        $this->assertSame('1 week ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndWeeks()
    {
        $d = IntlCarbon::now()->subWeeks(2);
        $this->assertSame('2 weeks ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndNearlyMonth()
    {
        $d = IntlCarbon::now()->subWeeks(3);
        $this->assertSame('3 weeks ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndMonth()
    {
        IntlCarbon::setTestNow(IntlCarbon::create(2012, 1, 1));
        $d = IntlCarbon::now()->subWeeks(4);
        $this->assertSame('4 weeks ago', $d->diffForHumans());
        $d = IntlCarbon::now()->subMonth();
        $this->assertSame('1 month ago', $d->diffForHumans());
        IntlCarbon::setTestNow();
    }

    public function testDiffForHumansNowAndMonths()
    {
        $d = IntlCarbon::now()->subMonths(2);
        $this->assertSame('2 months ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndNearlyYear()
    {
        $d = IntlCarbon::now()->subMonths(11);
        $this->assertSame('11 months ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndYear()
    {
        $d = IntlCarbon::now()->subYear();
        $this->assertSame('1 year ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndYears()
    {
        $d = IntlCarbon::now()->subYears(2);
        $this->assertSame('2 years ago', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndFutureSecond()
    {
        $d = IntlCarbon::now()->addSecond();
        $this->assertSame('1 second from now', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndFutureSeconds()
    {
        $d = IntlCarbon::now()->addSeconds(2);
        $this->assertSame('2 seconds from now', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndNearlyFutureMinute()
    {
        $d = IntlCarbon::now()->addSeconds(59);
        $this->assertSame('59 seconds from now', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndFutureMinute()
    {
        $d = IntlCarbon::now()->addMinute();
        $this->assertSame('1 minute from now', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndFutureMinutes()
    {
        $d = IntlCarbon::now()->addMinutes(2);
        $this->assertSame('2 minutes from now', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndNearlyFutureHour()
    {
        $d = IntlCarbon::now()->addMinutes(59);
        $this->assertSame('59 minutes from now', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndFutureHour()
    {
        $d = IntlCarbon::now()->addHour();
        $this->assertSame('1 hour from now', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndFutureHours()
    {
        $d = IntlCarbon::now()->addHours(2);
        $this->assertSame('2 hours from now', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndNearlyFutureDay()
    {
        IntlCarbon::setTestNow(IntlCarbon::create(2012, 1, 1));
        $d = IntlCarbon::now()->addHours(23);
        $this->assertSame('23 hours from now', $d->diffForHumans());
        IntlCarbon::setTestNow();
    }

    public function testDiffForHumansNowAndFutureDay()
    {
        $d = IntlCarbon::now()->addDay();
        $this->assertSame('1 day from now', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndFutureDays()
    {
        $d = IntlCarbon::now()->addDays(2);
        $this->assertSame('2 days from now', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndNearlyFutureWeek()
    {
        $d = IntlCarbon::now()->addDays(6);
        $this->assertSame('6 days from now', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndFutureWeek()
    {
        $d = IntlCarbon::now()->addWeek();
        $this->assertSame('1 week from now', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndFutureWeeks()
    {
        $d = IntlCarbon::now()->addWeeks(2);
        $this->assertSame('2 weeks from now', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndNearlyFutureMonth()
    {
        $d = IntlCarbon::now()->addWeeks(3);
        $this->assertSame('3 weeks from now', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndFutureMonth()
    {
        IntlCarbon::setTestNow(IntlCarbon::create(2012, 1, 1));
        $d = IntlCarbon::now()->addWeeks(4);
        $this->assertSame('4 weeks from now', $d->diffForHumans());
        $d = IntlCarbon::now()->addMonth();
        $this->assertSame('1 month from now', $d->diffForHumans());
        IntlCarbon::setTestNow();
    }

    public function testDiffForHumansNowAndFutureMonths()
    {
        IntlCarbon::setTestNow(IntlCarbon::create(2012, 1, 1));
        $d = IntlCarbon::now()->addMonths(2);
        $this->assertSame('2 months from now', $d->diffForHumans());
        IntlCarbon::setTestNow();
    }

    public function testDiffForHumansNowAndNearlyFutureYear()
    {
        $d = IntlCarbon::now()->addMonths(11);
        $this->assertSame('11 months from now', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndFutureYear()
    {
        $d = IntlCarbon::now()->addYear();
        $this->assertSame('1 year from now', $d->diffForHumans());
    }

    public function testDiffForHumansNowAndFutureYears()
    {
        $d = IntlCarbon::now()->addYears(2);
        $this->assertSame('2 years from now', $d->diffForHumans());
    }

    public function testDiffForHumansOtherAndSecond()
    {
        $d = IntlCarbon::now()->addSecond();
        $this->assertSame('1 second before', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndSeconds()
    {
        $d = IntlCarbon::now()->addSeconds(2);
        $this->assertSame('2 seconds before', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndNearlyMinute()
    {
        $d = IntlCarbon::now()->addSeconds(59);
        $this->assertSame('59 seconds before', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndMinute()
    {
        $d = IntlCarbon::now()->addMinute();
        $this->assertSame('1 minute before', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndMinutes()
    {
        $d = IntlCarbon::now()->addMinutes(2);
        $this->assertSame('2 minutes before', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndNearlyHour()
    {
        $d = IntlCarbon::now()->addMinutes(59);
        $this->assertSame('59 minutes before', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndHour()
    {
        $d = IntlCarbon::now()->addHour();
        $this->assertSame('1 hour before', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndHours()
    {
        $d = IntlCarbon::now()->addHours(2);
        $this->assertSame('2 hours before', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndNearlyDay()
    {
        IntlCarbon::setTestNow(IntlCarbon::create(2012, 1, 1));
        $d = IntlCarbon::now()->addHours(23);
        $this->assertSame('23 hours before', IntlCarbon::now()->diffForHumans($d));
        IntlCarbon::setTestNow();
    }

    public function testDiffForHumansOtherAndDay()
    {
        $d = IntlCarbon::now()->addDay();
        $this->assertSame('1 day before', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndDays()
    {
        $d = IntlCarbon::now()->addDays(2);
        $this->assertSame('2 days before', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndNearlyWeek()
    {
        $d = IntlCarbon::now()->addDays(6);
        $this->assertSame('6 days before', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndWeek()
    {
        $d = IntlCarbon::now()->addWeek();
        $this->assertSame('1 week before', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndWeeks()
    {
        $d = IntlCarbon::now()->addWeeks(2);
        $this->assertSame('2 weeks before', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndNearlyMonth()
    {
        $d = IntlCarbon::now()->addWeeks(3);
        $this->assertSame('3 weeks before', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndMonth()
    {
        IntlCarbon::setTestNow(IntlCarbon::create(2012, 1, 1));
        $d = IntlCarbon::now()->addWeeks(4);
        $this->assertSame('4 weeks before', IntlCarbon::now()->diffForHumans($d));
        $d = IntlCarbon::now()->addMonth();
        $this->assertSame('1 month before', IntlCarbon::now()->diffForHumans($d));
        IntlCarbon::setTestNow();
    }

    public function testDiffForHumansOtherAndMonths()
    {
        IntlCarbon::setTestNow(IntlCarbon::create(2012, 1, 1));
        $d = IntlCarbon::now()->addMonths(2);
        $this->assertSame('2 months before', IntlCarbon::now()->diffForHumans($d));
        IntlCarbon::setTestNow();
    }

    public function testDiffForHumansOtherAndNearlyYear()
    {
        $d = IntlCarbon::now()->addMonths(11);
        $this->assertSame('11 months before', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndYear()
    {
        $d = IntlCarbon::now()->addYear();
        $this->assertSame('1 year before', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndYears()
    {
        $d = IntlCarbon::now()->addYears(2);
        $this->assertSame('2 years before', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndFutureSecond()
    {
        $d = IntlCarbon::now()->subSecond();
        $this->assertSame('1 second after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndFutureSeconds()
    {
        $d = IntlCarbon::now()->subSeconds(2);
        $this->assertSame('2 seconds after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndNearlyFutureMinute()
    {
        $d = IntlCarbon::now()->subSeconds(59);
        $this->assertSame('59 seconds after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndFutureMinute()
    {
        $d = IntlCarbon::now()->subMinute();
        $this->assertSame('1 minute after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndFutureMinutes()
    {
        $d = IntlCarbon::now()->subMinutes(2);
        $this->assertSame('2 minutes after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndNearlyFutureHour()
    {
        $d = IntlCarbon::now()->subMinutes(59);
        $this->assertSame('59 minutes after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndFutureHour()
    {
        $d = IntlCarbon::now()->subHour();
        $this->assertSame('1 hour after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndFutureHours()
    {
        $d = IntlCarbon::now()->subHours(2);
        $this->assertSame('2 hours after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndNearlyFutureDay()
    {
        IntlCarbon::setTestNow(IntlCarbon::create(2012, 1, 15));
        $d = IntlCarbon::now()->subHours(23);
        $this->assertSame('23 hours after', IntlCarbon::now()->diffForHumans($d));
        IntlCarbon::setTestNow();
    }

    public function testDiffForHumansOtherAndFutureDay()
    {
        $d = IntlCarbon::now()->subDay();
        $this->assertSame('1 day after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndFutureDays()
    {
        $d = IntlCarbon::now()->subDays(2);
        $this->assertSame('2 days after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndNearlyFutureWeek()
    {
        $d = IntlCarbon::now()->subDays(6);
        $this->assertSame('6 days after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndFutureWeek()
    {
        $d = IntlCarbon::now()->subWeek();
        $this->assertSame('1 week after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndFutureWeeks()
    {
        $d = IntlCarbon::now()->subWeeks(2);
        $this->assertSame('2 weeks after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndNearlyFutureMonth()
    {
        $d = IntlCarbon::now()->subWeeks(3);
        $this->assertSame('3 weeks after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndFutureMonth()
    {
        IntlCarbon::setTestNow(IntlCarbon::create(2012, 1, 1));
        $d = IntlCarbon::now()->subWeeks(4);
        $this->assertSame('4 weeks after', IntlCarbon::now()->diffForHumans($d));
        $d = IntlCarbon::now()->subMonth();
        $this->assertSame('1 month after', IntlCarbon::now()->diffForHumans($d));
        IntlCarbon::setTestNow();
    }

    public function testDiffForHumansOtherAndFutureMonths()
    {
        $d = IntlCarbon::now()->subMonths(2);
        $this->assertSame('2 months after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndNearlyFutureYear()
    {
        $d = IntlCarbon::now()->subMonths(11);
        $this->assertSame('11 months after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndFutureYear()
    {
        $d = IntlCarbon::now()->subYear();
        $this->assertSame('1 year after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansOtherAndFutureYears()
    {
        $d = IntlCarbon::now()->subYears(2);
        $this->assertSame('2 years after', IntlCarbon::now()->diffForHumans($d));
    }

    public function testDiffForHumansAbsoluteSeconds()
    {
        $d = IntlCarbon::now()->subSeconds(59);
        $this->assertSame('59 seconds', IntlCarbon::now()->diffForHumans($d, true));
        $d = IntlCarbon::now()->addSeconds(59);
        $this->assertSame('59 seconds', IntlCarbon::now()->diffForHumans($d, true));
    }

    public function testDiffForHumansAbsoluteMinutes()
    {
        $d = IntlCarbon::now()->subMinutes(30);
        $this->assertSame('30 minutes', IntlCarbon::now()->diffForHumans($d, true));
        $d = IntlCarbon::now()->addMinutes(30);
        $this->assertSame('30 minutes', IntlCarbon::now()->diffForHumans($d, true));
    }

    public function testDiffForHumansAbsoluteHours()
    {
        $d = IntlCarbon::now()->subHours(3);
        $this->assertSame('3 hours', IntlCarbon::now()->diffForHumans($d, true));
        $d = IntlCarbon::now()->addHours(3);
        $this->assertSame('3 hours', IntlCarbon::now()->diffForHumans($d, true));
    }

    public function testDiffForHumansAbsoluteDays()
    {
        $d = IntlCarbon::now()->subDays(2);
        $this->assertSame('2 days', IntlCarbon::now()->diffForHumans($d, true));
        $d = IntlCarbon::now()->addDays(2);
        $this->assertSame('2 days', IntlCarbon::now()->diffForHumans($d, true));
    }

    public function testDiffForHumansAbsoluteWeeks()
    {
        $d = IntlCarbon::now()->subWeeks(2);
        $this->assertSame('2 weeks', IntlCarbon::now()->diffForHumans($d, true));
        $d = IntlCarbon::now()->addWeeks(2);
        $this->assertSame('2 weeks', IntlCarbon::now()->diffForHumans($d, true));
    }

    public function testDiffForHumansAbsoluteMonths()
    {
        IntlCarbon::setTestNow(IntlCarbon::create(2012, 1, 1));
        $d = IntlCarbon::now()->subMonths(2);
        $this->assertSame('2 months', IntlCarbon::now()->diffForHumans($d, true));
        $d = IntlCarbon::now()->addMonths(2);
        $this->assertSame('2 months', IntlCarbon::now()->diffForHumans($d, true));
        IntlCarbon::setTestNow();
    }

    public function testDiffForHumansAbsoluteYears()
    {
        $d = IntlCarbon::now()->subYears(1);
        $this->assertSame('1 year', IntlCarbon::now()->diffForHumans($d, true));
        $d = IntlCarbon::now()->addYears(1);
        $this->assertSame('1 year', IntlCarbon::now()->diffForHumans($d, true));
    }

    public function testDiffForHumansWithShorterMonthShouldStillBeAMonth()
    {
        $feb15 = IntlCarbon::parse('2015-02-15');
        $mar15 = IntlCarbon::parse('2015-03-15');
        $this->assertSame('1 month after', $mar15->diffForHumans($feb15));
    }
}
