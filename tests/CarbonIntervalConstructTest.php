<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Carbon\CarbonInterval;
use IntlCarbon\IntlCarbon;

class CarbonIntervalConstructTest extends TestFixture
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testInstanceWithDaysThrowsException()
    {
        $ci = CarbonInterval::instance(IntlCarbon::now()->diff(IntlCarbon::now()->addWeeks(3)));
    }
}
