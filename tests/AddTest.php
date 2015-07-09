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

class AddTest extends TestFixture
{
    public function testAddYearsPositive()
    {
        $this->assertSame(1976, IntlCarbon::createFromDate(1975)->addYears(1)->year);
        $this->assertSame(51, IntlCarbon::createFromDate(1975)->setCalendar('japanese')->addYears(1)->year);
        $this->assertSame(2519, IntlCarbon::createFromDate(1975)->setCalendar('buddhist')->addYears(1)->year);
        $this->assertSame(53, IntlCarbon::createFromDate(1975)->setCalendar('chinese')->addYears(1)->year);
        $this->assertSame(1355, IntlCarbon::createFromDate(1975)->setCalendar('persian')->addYears(1)->year);
        $this->assertSame(1898, IntlCarbon::createFromDate(1975)->setCalendar('indian')->addYears(1)->year);
        $this->assertSame(1396, IntlCarbon::createFromDate(1975)->setCalendar('islamic')->addYears(1)->year);
        $this->assertSame(5736, IntlCarbon::createFromDate(1975)->setCalendar('hebrew')->addYears(1)->year);
        $this->assertSame(1692, IntlCarbon::createFromDate(1975)->setCalendar('coptic')->addYears(1)->year);
        $this->assertSame(1968, IntlCarbon::createFromDate(1975)->setCalendar('ethiopic')->addYears(1)->year);
    }

    public function testAddYearsZero()
    {
        $this->assertSame(1975, IntlCarbon::createFromDate(1975)->addYears(0)->year);
        $this->assertSame(50, IntlCarbon::createFromDate(1975)->setCalendar('japanese')->addYears(0)->year);
        $this->assertSame(2518, IntlCarbon::createFromDate(1975)->setCalendar('buddhist')->addYears(0)->year);
        $this->assertSame(52, IntlCarbon::createFromDate(1975)->setCalendar('chinese')->addYears(0)->year);
        $this->assertSame(1354, IntlCarbon::createFromDate(1975)->setCalendar('persian')->addYears(0)->year);
        $this->assertSame(1897, IntlCarbon::createFromDate(1975)->setCalendar('indian')->addYears(0)->year);
        $this->assertSame(1395, IntlCarbon::createFromDate(1975)->setCalendar('islamic')->addYears(0)->year);
        $this->assertSame(5735, IntlCarbon::createFromDate(1975)->setCalendar('hebrew')->addYears(0)->year);
        $this->assertSame(1691, IntlCarbon::createFromDate(1975)->setCalendar('coptic')->addYears(0)->year);
        $this->assertSame(1967, IntlCarbon::createFromDate(1975)->setCalendar('ethiopic')->addYears(0)->year);
    }

    public function testAddYearsNegative()
    {
        $this->assertSame(1974, IntlCarbon::createFromDate(1975)->addYears(-1)->year);
        $this->assertSame(49, IntlCarbon::createFromDate(1975)->setCalendar('japanese')->addYears(-1)->year);
        $this->assertSame(2517, IntlCarbon::createFromDate(1975)->setCalendar('buddhist')->addYears(-1)->year);
        $this->assertSame(51, IntlCarbon::createFromDate(1975)->setCalendar('chinese')->addYears(-1)->year);
        $this->assertSame(1353, IntlCarbon::createFromDate(1975)->setCalendar('persian')->addYears(-1)->year);
        $this->assertSame(1896, IntlCarbon::createFromDate(1975)->setCalendar('indian')->addYears(-1)->year);
        $this->assertSame(1394, IntlCarbon::createFromDate(1975)->setCalendar('islamic')->addYears(-1)->year);
        $this->assertSame(5734, IntlCarbon::createFromDate(1975)->setCalendar('hebrew')->addYears(-1)->year);
        $this->assertSame(1690, IntlCarbon::createFromDate(1975)->setCalendar('coptic')->addYears(-1)->year);
        $this->assertSame(1966, IntlCarbon::createFromDate(1975)->setCalendar('ethiopic')->addYears(-1)->year);
    }

    public function testAddYear()
    {
        $this->assertSame(1976, IntlCarbon::createFromDate(1975)->addYear()->year);
        $this->assertSame(51, IntlCarbon::createFromDate(1975)->setCalendar('japanese')->addYear()->year);
        $this->assertSame(2519, IntlCarbon::createFromDate(1975)->setCalendar('buddhist')->addYear()->year);
        $this->assertSame(53, IntlCarbon::createFromDate(1975)->setCalendar('chinese')->addYear()->year);
        $this->assertSame(1355, IntlCarbon::createFromDate(1975)->setCalendar('persian')->addYear()->year);
        $this->assertSame(1898, IntlCarbon::createFromDate(1975)->setCalendar('indian')->addYear()->year);
        $this->assertSame(1396, IntlCarbon::createFromDate(1975)->setCalendar('islamic')->addYear()->year);
        $this->assertSame(5736, IntlCarbon::createFromDate(1975)->setCalendar('hebrew')->addYear()->year);
        $this->assertSame(1692, IntlCarbon::createFromDate(1975)->setCalendar('coptic')->addYear()->year);
        $this->assertSame(1968, IntlCarbon::createFromDate(1975)->setCalendar('ethiopic')->addYear()->year);
    }

    public function testAddMonthsPositive()
    {
        $this->assertSame(1, IntlCarbon::createFromDate(1975, 12)->addMonths(1)->month);
        $this->assertSame(8, IntlCarbon::createFromDate(1975)->setCalendar('japanese')->addMonths(1)->month);
        $this->assertSame(8, IntlCarbon::createFromDate(1975)->setCalendar('buddhist')->addMonths(1)->month);
        $this->assertSame(7, IntlCarbon::createFromDate(1975)->setCalendar('chinese')->addMonths(1)->month);
        $this->assertSame(5, IntlCarbon::createFromDate(1975)->setCalendar('persian')->addMonths(1)->month);
        $this->assertSame(5, IntlCarbon::createFromDate(1975)->setCalendar('indian')->addMonths(1)->month);
        $this->assertSame(8, IntlCarbon::createFromDate(1975)->setCalendar('islamic')->addMonths(1)->month);
        $this->assertSame(12, IntlCarbon::createFromDate(1975)->setCalendar('hebrew')->addMonths(1)->month);
        $this->assertSame(12, IntlCarbon::createFromDate(1975)->setCalendar('coptic')->addMonths(1)->month);
        $this->assertSame(12, IntlCarbon::createFromDate(1975)->setCalendar('ethiopic')->addMonths(1)->month);
    }

    public function testAddMonthsZero()
    {
        $this->assertSame(12, IntlCarbon::createFromDate(1975, 12)->addMonths(0)->month);
        $this->assertSame(12, IntlCarbon::createFromDate(1975, 12)->setCalendar('japanese')->addMonths(0)->month);
        $this->assertSame(12, IntlCarbon::createFromDate(1975, 12)->setCalendar('buddhist')->addMonths(0)->month);
        $this->assertSame(11, IntlCarbon::createFromDate(1975, 12)->setCalendar('chinese')->addMonths(0)->month);
        $this->assertSame(9, IntlCarbon::createFromDate(1975, 12)->setCalendar('persian')->addMonths(0)->month);
        $this->assertSame(9, IntlCarbon::createFromDate(1975, 12)->setCalendar('indian')->addMonths(0)->month);
        $this->assertSame(12, IntlCarbon::createFromDate(1975, 12)->setCalendar('islamic')->addMonths(0)->month);
        $this->assertSame(4, IntlCarbon::createFromDate(1975, 12)->setCalendar('hebrew')->addMonths(0)->month);
        $this->assertSame(3, IntlCarbon::createFromDate(1975, 12)->setCalendar('coptic')->addMonths(0)->month);
        $this->assertSame(3, IntlCarbon::createFromDate(1975, 12)->setCalendar('ethiopic')->addMonths(0)->month);
    }

    public function testAddMonthsNegative()
    {
        $this->assertSame(11, IntlCarbon::createFromDate(1975, 12, 1)->addMonths(-1)->month);
        $this->assertSame(11, IntlCarbon::createFromDate(1975, 12,1)->setCalendar('japanese')->addMonths(-1)->month);
        $this->assertSame(11, IntlCarbon::createFromDate(1975, 12,1)->setCalendar('buddhist')->addMonths(-1)->month);
        $this->assertSame(9, IntlCarbon::createFromDate(1975, 12,1)->setCalendar('chinese')->addMonths(-1)->month);
        $this->assertSame(8, IntlCarbon::createFromDate(1975, 12,1)->setCalendar('persian')->addMonths(-1)->month);
        $this->assertSame(8, IntlCarbon::createFromDate(1975, 1,12)->setCalendar('indian')->addMonths(-1)->month);
        $this->assertSame(10, IntlCarbon::createFromDate(1975, 12,1)->setCalendar('islamic')->addMonths(-1)->month);
        $this->assertSame(2, IntlCarbon::createFromDate(1975, 12,1)->setCalendar('hebrew')->addMonths(-1)->month);
        $this->assertSame(2, IntlCarbon::createFromDate(1975, 12,1)->setCalendar('coptic')->addMonths(-1)->month);
        $this->assertSame(2, IntlCarbon::createFromDate(1975, 12,1)->setCalendar('ethiopic')->addMonths(-1)->month);
    }

    public function testAddMonth()
    {
        $this->assertSame(1, IntlCarbon::createFromDate(1975, 12)->addMonth()->month);
        $this->assertSame(8, IntlCarbon::createFromDate(1975)->setCalendar('buddhist')->addMonth()->month);
        $this->assertSame(7, IntlCarbon::createFromDate(1975)->setCalendar('chinese')->addMonth()->month);
        $this->assertSame(5, IntlCarbon::createFromDate(1975)->setCalendar('persian')->addMonth()->month);
        $this->assertSame(5, IntlCarbon::createFromDate(1975)->setCalendar('indian')->addMonth()->month);
        $this->assertSame(8, IntlCarbon::createFromDate(1975)->setCalendar('islamic')->addMonth()->month);
        $this->assertSame(12, IntlCarbon::createFromDate(1975)->setCalendar('hebrew')->addMonth()->month);
        $this->assertSame(12, IntlCarbon::createFromDate(1975)->setCalendar('coptic')->addMonth()->month);
        $this->assertSame(12, IntlCarbon::createFromDate(1975)->setCalendar('ethiopic')->addMonth()->month);
    }

    public function testAddMonthWithOverflow()
    {
        $this->assertSame(3, IntlCarbon::createFromDate(2012, 1, 31)->addMonth()->month);
    }

    public function testAddMonthsNoOverflowPositive()
    {
        $this->assertSame('2012-02-29', IntlCarbon::createFromDate(2012, 1, 31)->addMonthNoOverflow()->toDateString());
        $this->assertSame('2012-03-31', IntlCarbon::createFromDate(2012, 1, 31)->addMonthsNoOverflow(2)->toDateString());
        $this->assertSame('2012-03-29', IntlCarbon::createFromDate(2012, 2, 29)->addMonthNoOverflow()->toDateString());
        $this->assertSame('2012-02-29', IntlCarbon::createFromDate(2011, 12, 31)->addMonthsNoOverflow(2)->toDateString());
    }

    public function testAddMonthsNoOverflowZero()
    {
        $this->assertSame(12, IntlCarbon::createFromDate(1975, 12)->addMonths(0)->month);
    }

    public function testAddMonthsNoOverflowNegative()
    {
        $this->assertSame('2012-01-29', IntlCarbon::createFromDate(2012, 2, 29)->addMonthsNoOverflow(-1)->toDateString());
        $this->assertSame('2012-01-31', IntlCarbon::createFromDate(2012, 3, 31)->addMonthsNoOverflow(-2)->toDateString());
        $this->assertSame('2012-02-29', IntlCarbon::createFromDate(2012, 3, 31)->addMonthsNoOverflow(-1)->toDateString());
        $this->assertSame('2011-12-31', IntlCarbon::createFromDate(2012, 1, 31)->addMonthsNoOverflow(-1)->toDateString());
    }

    public function testAddDaysPositive()
    {
        $this->assertSame(1, IntlCarbon::createFromDate(1975, 5, 31)->addDays(1)->day);
    }

    public function testAddDaysZero()
    {
        $this->assertSame(31, IntlCarbon::createFromDate(1975, 5, 31)->addDays(0)->day);
    }

    public function testAddDaysNegative()
    {
        $this->assertSame(30, IntlCarbon::createFromDate(1975, 5, 31)->addDays(-1)->day);
    }

    public function testAddDay()
    {
        $this->assertSame(1, IntlCarbon::createFromDate(1975, 5, 31)->addDay()->day);
    }

    public function testAddWeekdaysPositive()
    {
        $this->assertSame(17, IntlCarbon::createFromDate(2012, 1, 4)->addWeekdays(9)->day);
    }

    public function testAddWeekdaysZero()
    {
        $this->assertSame(4, IntlCarbon::createFromDate(2012, 1, 4)->addWeekdays(0)->day);
    }

    public function testAddWeekdaysNegative()
    {
        $this->assertSame(18, IntlCarbon::createFromDate(2012, 1, 31)->addWeekdays(-9)->day);
    }

    public function testAddWeekday()
    {
        $this->assertSame(9, IntlCarbon::createFromDate(2012, 1, 6)->addWeekday()->day);
    }

    public function testAddWeeksPositive()
    {
        $this->assertSame(28, IntlCarbon::createFromDate(1975, 5, 21)->addWeeks(1)->day);
    }

    public function testAddWeeksZero()
    {
        $this->assertSame(21, IntlCarbon::createFromDate(1975, 5, 21)->addWeeks(0)->day);
    }

    public function testAddWeeksNegative()
    {
        $this->assertSame(14, IntlCarbon::createFromDate(1975, 5, 21)->addWeeks(-1)->day);
    }

    public function testAddWeek()
    {
        $this->assertSame(28, IntlCarbon::createFromDate(1975, 5, 21)->addWeek()->day);
    }

    public function testAddHoursPositive()
    {
        $this->assertSame(1, IntlCarbon::createFromTime(0)->addHours(1)->hour);
    }

    public function testAddHoursZero()
    {
        $this->assertSame(0, IntlCarbon::createFromTime(0)->addHours(0)->hour);
    }

    public function testAddHoursNegative()
    {
        $this->assertSame(23, IntlCarbon::createFromTime(0)->addHours(-1)->hour);
    }

    public function testAddHour()
    {
        $this->assertSame(1, IntlCarbon::createFromTime(0)->addHour()->hour);
    }

    public function testAddMinutesPositive()
    {
        $this->assertSame(1, IntlCarbon::createFromTime(0, 0)->addMinutes(1)->minute);
    }

    public function testAddMinutesZero()
    {
        $this->assertSame(0, IntlCarbon::createFromTime(0, 0)->addMinutes(0)->minute);
    }

    public function testAddMinutesNegative()
    {
        $this->assertSame(59, IntlCarbon::createFromTime(0, 0)->addMinutes(-1)->minute);
    }

    public function testAddMinute()
    {
        $this->assertSame(1, IntlCarbon::createFromTime(0, 0)->addMinute()->minute);
    }

    public function testAddSecondsPositive()
    {
        $this->assertSame(1, IntlCarbon::createFromTime(0, 0, 0)->addSeconds(1)->second);
    }

    public function testAddSecondsZero()
    {
        $this->assertSame(0, IntlCarbon::createFromTime(0, 0, 0)->addSeconds(0)->second);
    }

    public function testAddSecondsNegative()
    {
        $this->assertSame(59, IntlCarbon::createFromTime(0, 0, 0)->addSeconds(-1)->second);
    }

    public function testAddSecond()
    {
        $this->assertSame(1, IntlCarbon::createFromTime(0, 0, 0)->addSecond()->second);
    }

    /***** Test non plural methods with non default args *****/

    public function testAddYearPassingArg()
    {
        $this->assertSame(1977, IntlCarbon::createFromDate(1975)->addYear(2)->year);
    }

    public function testAddMonthPassingArg()
    {
        $this->assertSame(7, IntlCarbon::createFromDate(1975, 5, 1)->addMonth(2)->month);
    }

    public function testAddMonthNoOverflowPassingArg()
    {
        $dt = IntlCarbon::createFromDate(2010, 12, 31)->addMonthNoOverflow(2);
        $this->assertSame(2011, $dt->year);
        $this->assertSame(2, $dt->month);
        $this->assertSame(28, $dt->day);
    }

    public function testAddDayPassingArg()
    {
        $this->assertSame(12, IntlCarbon::createFromDate(1975, 5, 10)->addDay(2)->day);
    }

    public function testAddHourPassingArg()
    {
        $this->assertSame(2, IntlCarbon::createFromTime(0)->addHour(2)->hour);
    }

    public function testAddMinutePassingArg()
    {
        $this->assertSame(2, IntlCarbon::createFromTime(0)->addMinute(2)->minute);
    }

    public function testAddSecondPassingArg()
    {
        $this->assertSame(2, IntlCarbon::createFromTime(0)->addSecond(2)->second);
    }
}
