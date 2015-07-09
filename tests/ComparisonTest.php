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

class ComparisonTest extends TestFixture
{
    public function testEqualToTrue()
    {
        $this->assertTrue(IntlCarbon::createFromDate(2000, 1, 1)->eq(IntlCarbon::createFromDate(2000, 1, 1)));
    }

    public function testEqualToFalse()
    {
        $this->assertFalse(IntlCarbon::createFromDate(2000, 1, 1)->eq(IntlCarbon::createFromDate(2000, 1, 2)));
    }

    public function testEqualWithTimezoneTrue()
    {
        $this->assertTrue(IntlCarbon::create(2000, 1, 1, 12, 0, 0, 'America/Toronto')->eq(IntlCarbon::create(2000, 1, 1, 9, 0, 0, 'America/Vancouver')));
    }

    public function testEqualWithTimezoneFalse()
    {
        $this->assertFalse(IntlCarbon::createFromDate(2000, 1, 1, 'America/Toronto')->eq(IntlCarbon::createFromDate(2000, 1, 1, 'America/Vancouver')));
    }

    public function testNotEqualToTrue()
    {
        $this->assertTrue(IntlCarbon::createFromDate(2000, 1, 1)->ne(IntlCarbon::createFromDate(2000, 1, 2)));
    }

    public function testNotEqualToFalse()
    {
        $this->assertFalse(IntlCarbon::createFromDate(2000, 1, 1)->ne(IntlCarbon::createFromDate(2000, 1, 1)));
    }

    public function testNotEqualWithTimezone()
    {
        $this->assertTrue(IntlCarbon::createFromDate(2000, 1, 1, 'America/Toronto')->ne(IntlCarbon::createFromDate(2000, 1, 1, 'America/Vancouver')));
    }

    public function testGreaterThanTrue()
    {
        $this->assertTrue(IntlCarbon::createFromDate(2000, 1, 1)->gt(IntlCarbon::createFromDate(1999, 12, 31)));
    }

    public function testGreaterThanFalse()
    {
        $this->assertFalse(IntlCarbon::createFromDate(2000, 1, 1)->gt(IntlCarbon::createFromDate(2000, 1, 2)));
    }

    public function testGreaterThanWithTimezoneTrue()
    {
        $dt1 = IntlCarbon::create(2000, 1, 1, 12, 0, 0, 'America/Toronto');
        $dt2 = IntlCarbon::create(2000, 1, 1, 8, 59, 59, 'America/Vancouver');
        $this->assertTrue($dt1->gt($dt2));
    }

    public function testGreaterThanWithTimezoneFalse()
    {
        $dt1 = IntlCarbon::create(2000, 1, 1, 12, 0, 0, 'America/Toronto');
        $dt2 = IntlCarbon::create(2000, 1, 1, 9, 0, 1, 'America/Vancouver');
        $this->assertFalse($dt1->gt($dt2));
    }

    public function testGreaterThanOrEqualTrue()
    {
        $this->assertTrue(IntlCarbon::createFromDate(2000, 1, 1)->gte(IntlCarbon::createFromDate(1999, 12, 31)));
    }

    public function testGreaterThanOrEqualTrueEqual()
    {
        $this->assertTrue(IntlCarbon::createFromDate(2000, 1, 1)->gte(IntlCarbon::createFromDate(2000, 1, 1)));
    }

    public function testGreaterThanOrEqualFalse()
    {
        $this->assertFalse(IntlCarbon::createFromDate(2000, 1, 1)->gte(IntlCarbon::createFromDate(2000, 1, 2)));
    }

    public function testLessThanTrue()
    {
        $this->assertTrue(IntlCarbon::createFromDate(2000, 1, 1)->lt(IntlCarbon::createFromDate(2000, 1, 2)));
    }

    public function testLessThanFalse()
    {
        $this->assertFalse(IntlCarbon::createFromDate(2000, 1, 1)->lt(IntlCarbon::createFromDate(1999, 12, 31)));
    }

    public function testLessThanOrEqualTrue()
    {
        $this->assertTrue(IntlCarbon::createFromDate(2000, 1, 1)->lte(IntlCarbon::createFromDate(2000, 1, 2)));
    }

    public function testLessThanOrEqualTrueEqual()
    {
        $this->assertTrue(IntlCarbon::createFromDate(2000, 1, 1)->lte(IntlCarbon::createFromDate(2000, 1, 1)));
    }

    public function testLessThanOrEqualFalse()
    {
        $this->assertFalse(IntlCarbon::createFromDate(2000, 1, 1)->lte(IntlCarbon::createFromDate(1999, 12, 31)));
    }

    public function testBetweenEqualTrue()
    {
        $this->assertTrue(IntlCarbon::createFromDate(2000, 1, 15)->between(IntlCarbon::createFromDate(2000, 1, 1), IntlCarbon::createFromDate(2000, 1, 31), true));
    }

    public function testBetweenNotEqualTrue()
    {
        $this->assertTrue(IntlCarbon::createFromDate(2000, 1, 15)->between(IntlCarbon::createFromDate(2000, 1, 1), IntlCarbon::createFromDate(2000, 1, 31), false));
    }

    public function testBetweenEqualFalse()
    {
        $this->assertFalse(IntlCarbon::createFromDate(1999, 12, 31)->between(IntlCarbon::createFromDate(2000, 1, 1), IntlCarbon::createFromDate(2000, 1, 31), true));
    }

    public function testBetweenNotEqualFalse()
    {
        $this->assertFalse(IntlCarbon::createFromDate(2000, 1, 1)->between(IntlCarbon::createFromDate(2000, 1, 1), IntlCarbon::createFromDate(2000, 1, 31), false));
    }

    public function testBetweenEqualSwitchTrue()
    {
        $this->assertTrue(IntlCarbon::createFromDate(2000, 1, 15)->between(IntlCarbon::createFromDate(2000, 1, 31), IntlCarbon::createFromDate(2000, 1, 1), true));
    }

    public function testBetweenNotEqualSwitchTrue()
    {
        $this->assertTrue(IntlCarbon::createFromDate(2000, 1, 15)->between(IntlCarbon::createFromDate(2000, 1, 31), IntlCarbon::createFromDate(2000, 1, 1), false));
    }

    public function testBetweenEqualSwitchFalse()
    {
        $this->assertFalse(IntlCarbon::createFromDate(1999, 12, 31)->between(IntlCarbon::createFromDate(2000, 1, 31), IntlCarbon::createFromDate(2000, 1, 1), true));
    }

    public function testBetweenNotEqualSwitchFalse()
    {
        $this->assertFalse(IntlCarbon::createFromDate(2000, 1, 1)->between(IntlCarbon::createFromDate(2000, 1, 31), IntlCarbon::createFromDate(2000, 1, 1), false));
    }

    public function testMinIsFluid()
    {
        $dt = IntlCarbon::now();
        $this->assertTrue($dt->min() instanceof IntlCarbon);
    }

    public function testMinWithNow()
    {
        $dt = IntlCarbon::create(2012, 1, 1, 0, 0, 0)->min();
        $this->assertIntlCarbon($dt, 2012, 1, 1, 0, 0, 0);
    }

    public function testMinWithInstance()
    {
        $dt1 = IntlCarbon::create(2013, 12, 31, 23, 59, 59);
        $dt2 = IntlCarbon::create(2012, 1, 1, 0, 0, 0)->min($dt1);
        $this->assertIntlCarbon($dt2, 2012, 1, 1, 0, 0, 0);
    }

    public function testMaxIsFluid()
    {
        $dt = IntlCarbon::now();
        $this->assertTrue($dt->max() instanceof IntlCarbon);
    }

    public function testMaxWithNow()
    {
        $dt = IntlCarbon::create(2099, 12, 31, 23, 59, 59)->max();
        $this->assertIntlCarbon($dt, 2099, 12, 31, 23, 59, 59);
    }

    public function testMaxWithInstance()
    {
        $dt1 = IntlCarbon::create(2012, 1, 1, 0, 0, 0);
        $dt2 = IntlCarbon::create(2099, 12, 31, 23, 59, 59)->max($dt1);
        $this->assertIntlCarbon($dt2, 2099, 12, 31, 23, 59, 59);
    }
    public function testIsBirthday()
    {
        $dt1 = IntlCarbon::createFromDate(1987, 4, 23);
        $dt2 = IntlCarbon::createFromDate(2014, 9, 26);
        $dt3 = IntlCarbon::createFromDate(2014, 4, 23);
        $this->assertFalse($dt2->isBirthday($dt1));
        $this->assertTrue($dt3->isBirthday($dt1));
    }
}
