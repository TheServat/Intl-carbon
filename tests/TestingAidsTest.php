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

class TestingAidsTest extends TestFixture
{
    public function testTestingAidsWithTestNowNotSet()
    {
        IntlCarbon::setTestNow();

        $this->assertFalse(IntlCarbon::hasTestNow());
        $this->assertNull(IntlCarbon::getTestNow());
    }

    public function testTestingAidsWithTestNowSet()
    {
        $notNow = IntlCarbon::yesterday();
        IntlCarbon::setTestNow($notNow);

        $this->assertTrue(IntlCarbon::hasTestNow());
        $this->assertSame($notNow, IntlCarbon::getTestNow());
    }

    public function testConstructorWithTestValueSet()
    {
        $notNow = IntlCarbon::yesterday();
        IntlCarbon::setTestNow($notNow);

        $this->assertEquals($notNow, new IntlCarbon());
        $this->assertEquals($notNow, new IntlCarbon(null));
        $this->assertEquals($notNow, new IntlCarbon(''));
        $this->assertEquals($notNow, new IntlCarbon('now'));
    }

    public function testNowWithTestValueSet()
    {
        $notNow = IntlCarbon::yesterday();
        IntlCarbon::setTestNow($notNow);

        $this->assertEquals($notNow, IntlCarbon::now());
    }

    public function testParseWithTestValueSet()
    {
        $notNow = IntlCarbon::yesterday();
        IntlCarbon::setTestNow($notNow);

        $this->assertEquals($notNow, IntlCarbon::parse());
        $this->assertEquals($notNow, IntlCarbon::parse(null));
        $this->assertEquals($notNow, IntlCarbon::parse(''));
        $this->assertEquals($notNow, IntlCarbon::parse('now'));
    }

    public function testParseRelativeWithTestValueSet()
    {
        $notNow = IntlCarbon::parse('2013-09-01 05:15:05');
        IntlCarbon::setTestNow($notNow);

        $this->assertSame('2013-09-01 05:10:05', IntlCarbon::parse('5 minutes ago')->toDateTimeString());

        $this->assertSame('2013-08-25 05:15:05', IntlCarbon::parse('1 week ago')->toDateTimeString());

        $this->assertSame('2013-09-02 00:00:00', IntlCarbon::parse('tomorrow')->toDateTimeString());
        $this->assertSame('2013-08-31 00:00:00', IntlCarbon::parse('yesterday')->toDateTimeString());

        $this->assertSame('2013-09-02 05:15:05', IntlCarbon::parse('+1 day')->toDateTimeString());
        $this->assertSame('2013-08-31 05:15:05', IntlCarbon::parse('-1 day')->toDateTimeString());

        $this->assertSame('2013-09-02 00:00:00', IntlCarbon::parse('next monday')->toDateTimeString());
        $this->assertSame('2013-09-03 00:00:00', IntlCarbon::parse('next tuesday')->toDateTimeString());
        $this->assertSame('2013-09-04 00:00:00', IntlCarbon::parse('next wednesday')->toDateTimeString());
        $this->assertSame('2013-09-05 00:00:00', IntlCarbon::parse('next thursday')->toDateTimeString());
        $this->assertSame('2013-09-06 00:00:00', IntlCarbon::parse('next friday')->toDateTimeString());
        $this->assertSame('2013-09-07 00:00:00', IntlCarbon::parse('next saturday')->toDateTimeString());
        $this->assertSame('2013-09-08 00:00:00', IntlCarbon::parse('next sunday')->toDateTimeString());

        $this->assertSame('2013-08-26 00:00:00', IntlCarbon::parse('last monday')->toDateTimeString());
        $this->assertSame('2013-08-27 00:00:00', IntlCarbon::parse('last tuesday')->toDateTimeString());
        $this->assertSame('2013-08-28 00:00:00', IntlCarbon::parse('last wednesday')->toDateTimeString());
        $this->assertSame('2013-08-29 00:00:00', IntlCarbon::parse('last thursday')->toDateTimeString());
        $this->assertSame('2013-08-30 00:00:00', IntlCarbon::parse('last friday')->toDateTimeString());
        $this->assertSame('2013-08-31 00:00:00', IntlCarbon::parse('last saturday')->toDateTimeString());
        $this->assertSame('2013-08-25 00:00:00', IntlCarbon::parse('last sunday')->toDateTimeString());

        $this->assertSame('2013-09-02 00:00:00', IntlCarbon::parse('this monday')->toDateTimeString());
        $this->assertSame('2013-09-03 00:00:00', IntlCarbon::parse('this tuesday')->toDateTimeString());
        $this->assertSame('2013-09-04 00:00:00', IntlCarbon::parse('this wednesday')->toDateTimeString());
        $this->assertSame('2013-09-05 00:00:00', IntlCarbon::parse('this thursday')->toDateTimeString());
        $this->assertSame('2013-09-06 00:00:00', IntlCarbon::parse('this friday')->toDateTimeString());
        $this->assertSame('2013-09-07 00:00:00', IntlCarbon::parse('this saturday')->toDateTimeString());
        $this->assertSame('2013-09-01 00:00:00', IntlCarbon::parse('this sunday')->toDateTimeString());

        $this->assertSame('2013-10-01 05:15:05', IntlCarbon::parse('first day of next month')->toDateTimeString());
        $this->assertSame('2013-09-30 05:15:05', IntlCarbon::parse('last day of this month')->toDateTimeString());
    }

    public function testParseRelativeWithMinusSignsInDate()
    {
        $notNow = IntlCarbon::parse('2013-09-01 05:15:05');
        IntlCarbon::setTestNow($notNow);

        $this->assertSame('2000-01-03 00:00:00', IntlCarbon::parse('2000-1-3')->toDateTimeString());
        $this->assertSame('2000-10-10 00:00:00', IntlCarbon::parse('2000-10-10')->toDateTimeString());
    }

    public function testTimeZoneWithTestValueSet()
    {
        $notNow = IntlCarbon::parse('2013-07-01 12:00:00', 'America/New_York');
        IntlCarbon::setTestNow($notNow);

        $this->assertSame('2013-07-01T12:00:00-0400', IntlCarbon::parse('now')->toIso8601String());
        $this->assertSame('2013-07-01T11:00:00-0500', IntlCarbon::parse('now', 'America/Mexico_City')->toIso8601String());
        $this->assertSame('2013-07-01T09:00:00-0700', IntlCarbon::parse('now', 'America/Vancouver')->toIso8601String());
    }
}
