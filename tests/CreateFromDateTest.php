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

class CreateFromDateTest extends TestFixture
{
    public function testCreateFromDateWithDefaults()
    {
        $d = IntlCarbon::createFromDate();
        $this->assertSame($d->timestamp, IntlCarbon::create(null, null, null, null, null, null)->timestamp);
    }

    public function testCreateFromDate()
    {
        $d = IntlCarbon::createFromDate(1975, 5, 21);
        $this->assertIntlCarbon($d, 1975, 5, 21);
    }

    public function testCreateFromDateWithYear()
    {
        $d = IntlCarbon::createFromDate(1975);
        $this->assertSame(1975, $d->year);
    }

    public function testCreateFromDateWithMonth()
    {
        $d = IntlCarbon::createFromDate(null, 5);
        $this->assertSame(5, $d->month);
    }

    public function testCreateFromDateWithDay()
    {
        $d = IntlCarbon::createFromDate(null, null, 21);
        $this->assertSame(21, $d->day);
    }

    public function testCreateFromDateWithTimezone()
    {
        $d = IntlCarbon::createFromDate(1975, 5, 21, 'Europe/London');
        $this->assertIntlCarbon($d, 1975, 5, 21);
        $this->assertSame('Europe/London', $d->tzName);
    }

    public function testCreateFromDateWithDateTimeZone()
    {
        $d = IntlCarbon::createFromDate(1975, 5, 21, new \DateTimeZone('Europe/London'));
        $this->assertIntlCarbon($d, 1975, 5, 21);
        $this->assertSame('Europe/London', $d->tzName);
    }
}
