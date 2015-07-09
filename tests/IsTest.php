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

class IsTest extends TestFixture
{
    public function testIsWeekdayTrue()
    {
        $this->assertTrue(IntlCarbon::createFromDate(2012, 1, 2)->isWeekday());
    }

    public function testIsWeekdayFalse()
    {
        $this->assertFalse(IntlCarbon::createFromDate(2012, 1, 1)->isWeekday());
    }

    public function testIsWeekendTrue()
    {
        $this->assertTrue(IntlCarbon::createFromDate(2012, 1, 1)->isWeekend());
    }

    public function testIsWeekendFalse()
    {
        $this->assertFalse(IntlCarbon::createFromDate(2012, 1, 2)->isWeekend());
    }

    public function testIsYesterdayTrue()
    {
        $this->assertTrue(IntlCarbon::now()->subDay()->isYesterday());
    }

    public function testIsYesterdayFalseWithToday()
    {
        $this->assertFalse(IntlCarbon::now()->endOfDay()->isYesterday());
    }

    public function testIsYesterdayFalseWith2Days()
    {
        $this->assertFalse(IntlCarbon::now()->subDays(2)->startOfDay()->isYesterday());
    }

    public function testIsTodayTrue()
    {
        $this->assertTrue(IntlCarbon::now()->isToday());
    }

    public function testIsTodayFalseWithYesterday()
    {
        $this->assertFalse(IntlCarbon::now()->subDay()->endOfDay()->isToday());
    }

    public function testIsTodayFalseWithTomorrow()
    {
        $this->assertFalse(IntlCarbon::now()->addDay()->startOfDay()->isToday());
    }

    public function testIsTodayWithTimezone()
    {
        $this->assertTrue(IntlCarbon::now('Asia/Tokyo')->isToday());
    }

    public function testIsTomorrowTrue()
    {
        $this->assertTrue(IntlCarbon::now()->addDay()->isTomorrow());
    }

    public function testIsTomorrowFalseWithToday()
    {
        $this->assertFalse(IntlCarbon::now()->endOfDay()->isTomorrow());
    }

    public function testIsTomorrowFalseWith2Days()
    {
        $this->assertFalse(IntlCarbon::now()->addDays(2)->startOfDay()->isTomorrow());
    }

    public function testIsFutureTrue()
    {
        $this->assertTrue(IntlCarbon::now()->addSecond()->isFuture());
    }

    public function testIsFutureFalse()
    {
        $this->assertFalse(IntlCarbon::now()->isFuture());
    }

    public function testIsFutureFalseInThePast()
    {
        $this->assertFalse(IntlCarbon::now()->subSecond()->isFuture());
    }

    public function testIsPastTrue()
    {
        $this->assertTrue(IntlCarbon::now()->subSecond()->isPast());
    }

    public function testIsPastFalse()
    {
        $this->assertFalse(IntlCarbon::now()->addSecond()->isPast());
        $this->assertFalse(IntlCarbon::now()->isPast());
    }

    public function testIsLeapYearTrue()
    {
        $this->assertTrue(IntlCarbon::createFromDate(2016, 1, 1)->isLeapYear());
    }

    public function testIsLeapYearFalse()
    {
        $this->assertFalse(IntlCarbon::createFromDate(2014, 1, 1)->isLeapYear());
    }

    public function testIsSameDayTrue()
    {
        $current = IntlCarbon::createFromDate(2012, 1, 2);
        $this->assertTrue($current->isSameDay(IntlCarbon::createFromDate(2012, 1, 2)));
    }

    public function testIsSameDayFalse()
    {
        $current = IntlCarbon::createFromDate(2012, 1, 2);
        $this->assertFalse($current->isSameDay(IntlCarbon::createFromDate(2012, 1, 3)));
    }
}
