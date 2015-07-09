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

class CreateFromTimeTest extends TestFixture
{
    public function testCreateFromDateWithDefaults()
    {
        $d = IntlCarbon::createFromTime();
        $this->assertSame($d->timestamp, IntlCarbon::create(null, null, null, null, null, null)->timestamp);
    }

    public function testCreateFromDate()
    {
        $d = IntlCarbon::createFromTime(23, 5, 21);
        $this->assertIntlCarbon($d, IntlCarbon::now()->year, IntlCarbon::now()->month, IntlCarbon::now()->day, 23, 5, 21);
    }

    public function testCreateFromTimeWithHour()
    {
        $d = IntlCarbon::createFromTime(22);
        $this->assertSame(22, $d->hour);
        $this->assertSame(0, $d->minute);
        $this->assertSame(0, $d->second);
    }

    public function testCreateFromTimeWithMinute()
    {
        $d = IntlCarbon::createFromTime(null, 5);
        $this->assertSame(5, $d->minute);
    }

    public function testCreateFromTimeWithSecond()
    {
        $d = IntlCarbon::createFromTime(null, null, 21);
        $this->assertSame(21, $d->second);
    }

    public function testCreateFromTimeWithDateTimeZone()
    {
        $d = IntlCarbon::createFromTime(12, 0, 0, new \DateTimeZone('Europe/London'));
        $this->assertIntlCarbon($d, IntlCarbon::now()->year, IntlCarbon::now()->month, IntlCarbon::now()->day, 12, 0, 0);
        $this->assertSame('Europe/London', $d->tzName);
    }

    public function testCreateFromTimeWithTimeZoneString()
    {
        $d = IntlCarbon::createFromTime(12, 0, 0, 'Europe/London');
        $this->assertIntlCarbon($d, IntlCarbon::now()->year, IntlCarbon::now()->month, IntlCarbon::now()->day, 12, 0, 0);
        $this->assertSame('Europe/London', $d->tzName);
    }
}
