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

class NowAndOtherStaticHelpersTest extends TestFixture
{
    public function testNow()
    {
        $dt = IntlCarbon::now();
        $this->assertSame(time(), $dt->timestamp);
    }

    public function testNowWithTimezone()
    {
        $dt = IntlCarbon::now('Europe/London');
        $this->assertSame(time(), $dt->timestamp);
        $this->assertSame('Europe/London', $dt->tzName);
    }

    public function testToday()
    {
        $dt = IntlCarbon::today();
        $this->assertSame(date('Y-m-d 00:00:00'), $dt->toDateTimeString());
    }

    public function testTodayWithTimezone()
    {
        $dt = IntlCarbon::today('Europe/London');
        $dt2 = new \DateTime('now', new \DateTimeZone('Europe/London'));
        $this->assertSame($dt2->format('Y-m-d 00:00:00'), $dt->toDateTimeString());
    }

    public function testTomorrow()
    {
        $dt = IntlCarbon::tomorrow();
        $dt2 = new \DateTime('tomorrow');
        $this->assertSame($dt2->format('Y-m-d 00:00:00'), $dt->toDateTimeString());
    }

    public function testTomorrowWithTimezone()
    {
        $dt = IntlCarbon::tomorrow('Europe/London');
        $dt2 = new \DateTime('tomorrow', new \DateTimeZone('Europe/London'));
        $this->assertSame($dt2->format('Y-m-d 00:00:00'), $dt->toDateTimeString());
    }

    public function testYesterday()
    {
        $dt = IntlCarbon::yesterday();
        $dt2 = new \DateTime('yesterday');
        $this->assertSame($dt2->format('Y-m-d 00:00:00'), $dt->toDateTimeString());
    }

    public function testYesterdayWithTimezone()
    {
        $dt = IntlCarbon::yesterday('Europe/London');
        $dt2 = new \DateTime('yesterday', new \DateTimeZone('Europe/London'));
        $this->assertSame($dt2->format('Y-m-d 00:00:00'), $dt->toDateTimeString());
    }

    public function testMinValue()
    {
        $this->assertLessThanOrEqual(- 2147483647, IntlCarbon::minValue()->getTimestamp());
    }

    public function testMaxValue()
    {
        $this->assertGreaterThanOrEqual(2147483647, IntlCarbon::maxValue()->getTimestamp());
    }
}
