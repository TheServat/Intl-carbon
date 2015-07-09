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

class ConstructTest extends TestFixture
{
    public function testCreatesAnInstanceDefaultToNow()
    {
        $c = new IntlCarbon();
        $now = IntlCarbon::now();
        $this->assertInstanceOfIntlCarbon($c);
        $this->assertSame($now->tzName, $c->tzName);
        $this->assertIntlCarbon($c, $now->year, $now->month, $now->day, $now->hour, $now->minute, $now->second);
    }

    public function testParseCreatesAnInstanceDefaultToNow()
    {
        $c = IntlCarbon::parse();
        $now = IntlCarbon::now();
        $this->assertInstanceOfIntlCarbon($c);
        $this->assertSame($now->tzName, $c->tzName);
        $this->assertIntlCarbon($c, $now->year, $now->month, $now->day, $now->hour, $now->minute, $now->second);
    }

    public function testWithFancyString()
    {
        $c = new IntlCarbon('first day of January 2008');
        $this->assertIntlCarbon($c, 2008, 1, 1, 0, 0, 0);
    }

    public function testParseWithFancyString()
    {
        $c = IntlCarbon::parse('first day of January 2008');
        $this->assertIntlCarbon($c, 2008, 1, 1, 0, 0, 0);
    }

    public function testDefaultTimezone()
    {
        $c = new IntlCarbon('now');
        $this->assertSame('America/Toronto', $c->tzName);
    }

    public function testParseWithDefaultTimezone()
    {
        $c = IntlCarbon::parse('now');
        $this->assertSame('America/Toronto', $c->tzName);
    }

    public function testSettingTimezone()
    {
        $timezone = 'Europe/London';
        $dtz = new \DateTimeZone($timezone);
        $dt = new \DateTime('now', $dtz);
        $dayLightSavingTimeOffset = $dt->format('I');

        $c = new IntlCarbon('now', $dtz);
        $this->assertSame($timezone, $c->tzName);
        $this->assertSame(0 + $dayLightSavingTimeOffset, $c->offsetHours);
    }

    public function testParseSettingTimezone()
    {
        $timezone = 'Europe/London';
        $dtz = new \DateTimeZone($timezone);
        $dt = new \DateTime('now', $dtz);
        $dayLightSavingTimeOffset = $dt->format('I');

        $c = IntlCarbon::parse('now', $dtz);
        $this->assertSame($timezone, $c->tzName);
        $this->assertSame(0 + $dayLightSavingTimeOffset, $c->offsetHours);
    }

    public function testSettingTimezoneWithString()
    {
        $timezone = 'Asia/Tokyo';
        $dtz = new \DateTimeZone($timezone);
        $dt = new \DateTime('now', $dtz);
        $dayLightSavingTimeOffset = $dt->format('I');

        $c = new IntlCarbon('now', $timezone);
        $this->assertSame($timezone, $c->tzName);
        $this->assertSame(9 + $dayLightSavingTimeOffset, $c->offsetHours);
    }

    public function testParseSettingTimezoneWithString()
    {
        $timezone = 'Asia/Tokyo';
        $dtz = new \DateTimeZone($timezone);
        $dt = new \DateTime('now', $dtz);
        $dayLightSavingTimeOffset = $dt->format('I');

        $c = IntlCarbon::parse('now', $timezone);
        $this->assertSame($timezone, $c->tzName);
        $this->assertSame(9 + $dayLightSavingTimeOffset, $c->offsetHours);
    }
}
