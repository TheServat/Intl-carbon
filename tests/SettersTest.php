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

class SettersTest extends TestFixture
{
    public function testYearSetter()
    {
        $d = IntlCarbon::now();
        $d->year = 1995;
        $this->assertSame(1995, $d->year);
    }

    public function testMonthSetter()
    {
        $d = IntlCarbon::now();
        $d->month = 3;
        $this->assertSame(3, $d->month);
    }

    public function testMonthSetterWithWrap()
    {
        $d = IntlCarbon::now();
        $d->month = 13;
        $this->assertSame(1, $d->month);
    }

    public function testDaySetter()
    {
        $d = IntlCarbon::now();
        $d->day = 2;
        $this->assertSame(2, $d->day);
    }

    public function testDaySetterWithWrap()
    {
        $d = IntlCarbon::createFromDate(2012, 8, 5);
        $d->day = 32;
        $this->assertSame(1, $d->day);
    }

    public function testHourSetter()
    {
        $d = IntlCarbon::now();
        $d->hour = 2;
        $this->assertSame(2, $d->hour);
    }

    public function testHourSetterWithWrap()
    {
        $d = IntlCarbon::now();
        $d->hour = 25;
        $this->assertSame(1, $d->hour);
    }

    public function testMinuteSetter()
    {
        $d = IntlCarbon::now();
        $d->minute = 2;
        $this->assertSame(2, $d->minute);
    }

    public function testMinuteSetterWithWrap()
    {
        $d = IntlCarbon::now();
        $d->minute = 65;
        $this->assertSame(5, $d->minute);
    }

    public function testSecondSetter()
    {
        $d = IntlCarbon::now();
        $d->second = 2;
        $this->assertSame(2, $d->second);
    }

    public function testTimeSetter()
    {
        $d = IntlCarbon::now();
        $d->setTime(1, 1, 1);
        $this->assertSame(1, $d->second);
        $d->setTime(1, 1);
        $this->assertSame(0, $d->second);
    }

    public function testTimeSetterWithChaining()
    {
        $d = IntlCarbon::now();
        $d->setTime(2, 2, 2)->setTime(1, 1, 1);
        $this->assertInstanceOf('IntlCarbon\IntlCarbon', $d);
        $this->assertSame(1, $d->second);
        $d->setTime(2, 2, 2)->setTime(1, 1);
        $this->assertInstanceOf('IntlCarbon\IntlCarbon', $d);
        $this->assertSame(0, $d->second);
    }

    public function testTimeSetterWithZero()
    {
        $d = IntlCarbon::now();
        $d->setTime(1, 1);
        $this->assertSame(0, $d->second);
    }

    public function testDateTimeSetter()
    {
        $d = IntlCarbon::now();
        $d->setDateTime($d->year, $d->month, $d->day, 1, 1, 1);
        $this->assertSame(1, $d->second);
    }

    public function testDateTimeSetterWithZero()
    {
        $d = IntlCarbon::now();
        $d->setDateTime($d->year, $d->month, $d->day, 1, 1);
        $this->assertSame(0, $d->second);
    }

    public function testDateTimeSetterWithChaining()
    {
        $d = IntlCarbon::now();
        $d->setDateTime(2013, 9, 24, 17, 4, 29);
        $this->assertInstanceOf('IntlCarbon\IntlCarbon', $d);
        $d->setDateTime(2014, 10, 25, 18, 5, 30);
        $this->assertInstanceOf('IntlCarbon\IntlCarbon', $d);
        $this->assertIntlCarbon($d, 2014, 10, 25, 18, 5, 30);
    }

    public function testSecondSetterWithWrap()
    {
        $d = IntlCarbon::now();
        $d->second = 65;
        $this->assertSame(5, $d->second);
    }

    public function testTimestampSetter()
    {
        $d = IntlCarbon::now();
        $d->timestamp = 10;
        $this->assertSame(10, $d->timestamp);

        $d->setTimestamp(11);
        $this->assertSame(11, $d->timestamp);
    }

    public function testSetTimezoneWithInvalidTimezone()
    {
        $this->setExpectedException('InvalidArgumentException');
        $d = IntlCarbon::now();
        $d->setTimezone('sdf');
    }

    public function testTimezoneWithInvalidTimezone()
    {
        $d = IntlCarbon::now();

        try {
            $d->timezone = 'sdf';
            $this->fail('InvalidArgumentException was not been raised.');
        } catch (InvalidArgumentException $expected) {
        }

        try {
            $d->timezone('sdf');
            $this->fail('InvalidArgumentException was not been raised.');
        } catch (InvalidArgumentException $expected) {
        }
    }
    public function testTzWithInvalidTimezone()
    {
        $d = IntlCarbon::now();

        try {
            $d->tz = 'sdf';
            $this->fail('InvalidArgumentException was not been raised.');
        } catch (InvalidArgumentException $expected) {
        }

        try {
            $d->tz('sdf');
            $this->fail('InvalidArgumentException was not been raised.');
        } catch (InvalidArgumentException $expected) {
        }
    }
    public function testSetTimezoneUsingString()
    {
        $d = IntlCarbon::now();
        $d->setTimezone('America/Toronto');
        $this->assertSame('America/Toronto', $d->tzName);
    }

    public function testTimezoneUsingString()
    {
        $d = IntlCarbon::now();
        $d->timezone = 'America/Toronto';
        $this->assertSame('America/Toronto', $d->tzName);

        $d->timezone('America/Vancouver');
        $this->assertSame('America/Vancouver', $d->tzName);
    }

    public function testTzUsingString()
    {
        $d = IntlCarbon::now();
        $d->tz = 'America/Toronto';
        $this->assertSame('America/Toronto', $d->tzName);

        $d->tz('America/Vancouver');
        $this->assertSame('America/Vancouver', $d->tzName);
    }

    public function testSetTimezoneUsingDateTimeZone()
    {
        $d = IntlCarbon::now();
        $d->setTimezone(new \DateTimeZone('America/Toronto'));
        $this->assertSame('America/Toronto', $d->tzName);
    }

    public function testTimezoneUsingDateTimeZone()
    {
        $d = IntlCarbon::now();
        $d->timezone = new \DateTimeZone('America/Toronto');
        $this->assertSame('America/Toronto', $d->tzName);

        $d->timezone(new \DateTimeZone('America/Vancouver'));
        $this->assertSame('America/Vancouver', $d->tzName);
    }

    public function testTzUsingDateTimeZone()
    {
        $d = IntlCarbon::now();
        $d->tz = new \DateTimeZone('America/Toronto');
        $this->assertSame('America/Toronto', $d->tzName);

        $d->tz(new \DateTimeZone('America/Vancouver'));
        $this->assertSame('America/Vancouver', $d->tzName);
    }

    public function testInvalidSetter()
    {
        $this->setExpectedException('InvalidArgumentException');
        $d = IntlCarbon::now();
        $d->doesNotExit = 'bb';
    }
}
