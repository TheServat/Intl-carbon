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

class InstanceTest extends TestFixture
{
    public function testInstanceFromDateTime()
    {
        $dating = IntlCarbon::instance(\DateTime::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11'));
        $this->assertIntlCarbon($dating, 1975, 5, 21, 22, 32, 11);
    }

    public function testInstanceFromDateTimeKeepsTimezoneName()
    {
        $dating = IntlCarbon::instance(\DateTime::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11')->setTimezone(new \DateTimeZone('America/Vancouver')));
        $this->assertSame('America/Vancouver', $dating->tzName);
    }

    public function testInstanceFromDateTimeKeepsMicros()
    {
        $micro = 254687;
        $datetime = \DateTime::createFromFormat('Y-m-d H:i:s.u', '2014-02-01 03:45:27.'.$micro);
        $IntlCarbon = IntlCarbon::instance($datetime);
        $this->assertSame($micro, $IntlCarbon->micro);
    }
}
