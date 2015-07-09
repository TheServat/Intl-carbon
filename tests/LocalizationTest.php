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
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;

class LocalizationTest extends TestFixture
{
    public function testGetTranslator()
    {
        $t = IntlCarbon::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame('en', $t->getLocale());
    }

    public function testSetTranslator()
    {
        $t = new Translator('fr');
        $t->addLoader('array', new ArrayLoader());
        IntlCarbon::setTranslator($t);

        $t = IntlCarbon::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame('fr', $t->getLocale());
    }

    public function testGetLocale()
    {
        IntlCarbon::setLocale('en');
        $this->assertSame('en', IntlCarbon::getLocale());
    }

    public function testSetLocale()
    {
        IntlCarbon::setLocale('en');
        $this->assertSame('en', IntlCarbon::getLocale());
        IntlCarbon::setLocale('fr');
        $this->assertSame('fr', IntlCarbon::getLocale());
    }

    /**
     * The purpose of these tests aren't to test the validitity of the translation
     * but more so to test that the language file exists.
     */

    public function testDiffForHumansLocalizedInFrench()
    {
        IntlCarbon::setLocale('fr');

        $d = IntlCarbon::now()->subSecond();
        $this->assertSame('il y a 1 seconde', $d->diffForHumans());

        $d = IntlCarbon::now()->subSeconds(2);
        $this->assertSame('il y a 2 secondes', $d->diffForHumans());

        $d = IntlCarbon::now()->subMinute();
        $this->assertSame('il y a 1 minute', $d->diffForHumans());

        $d = IntlCarbon::now()->subMinutes(2);
        $this->assertSame('il y a 2 minutes', $d->diffForHumans());

        $d = IntlCarbon::now()->subHour();
        $this->assertSame('il y a 1 heure', $d->diffForHumans());

        $d = IntlCarbon::now()->subHours(2);
        $this->assertSame('il y a 2 heures', $d->diffForHumans());

        $d = IntlCarbon::now()->subDay();
        $this->assertSame('il y a 1 jour', $d->diffForHumans());

        $d = IntlCarbon::now()->subDays(2);
        $this->assertSame('il y a 2 jours', $d->diffForHumans());

        $d = IntlCarbon::now()->subWeek();
        $this->assertSame('il y a 1 semaine', $d->diffForHumans());

        $d = IntlCarbon::now()->subWeeks(2);
        $this->assertSame('il y a 2 semaines', $d->diffForHumans());

        $d = IntlCarbon::now()->subMonth();
        $this->assertSame('il y a 1 mois', $d->diffForHumans());

        $d = IntlCarbon::now()->subMonths(2);
        $this->assertSame('il y a 2 mois', $d->diffForHumans());

        $d = IntlCarbon::now()->subYear();
        $this->assertSame('il y a 1 an', $d->diffForHumans());

        $d = IntlCarbon::now()->subYears(2);
        $this->assertSame('il y a 2 ans', $d->diffForHumans());

        $d = IntlCarbon::now()->addSecond();
        $this->assertSame('dans 1 seconde', $d->diffForHumans());

        $d = IntlCarbon::now()->addSecond();
        $d2 = IntlCarbon::now();
        $this->assertSame('1 seconde après', $d->diffForHumans($d2));
        $this->assertSame('1 seconde avant', $d2->diffForHumans($d));

        $this->assertSame('1 seconde', $d->diffForHumans($d2, true));
        $this->assertSame('2 secondes', $d2->diffForHumans($d->addSecond(), true));
    }

    public function testDiffForHumansLocalizedInSpanish()
    {
        IntlCarbon::setLocale('es');

        $d = IntlCarbon::now()->subSecond();
        $this->assertSame('hace 1 segundo', $d->diffForHumans());

        $d = IntlCarbon::now()->subSeconds(3);
        $this->assertSame('hace 3 segundos', $d->diffForHumans());

        $d = IntlCarbon::now()->subMinute();
        $this->assertSame('hace 1 minuto', $d->diffForHumans());

        $d = IntlCarbon::now()->subMinutes(2);
        $this->assertSame('hace 2 minutos', $d->diffForHumans());

        $d = IntlCarbon::now()->subHour();
        $this->assertSame('hace 1 hora', $d->diffForHumans());

        $d = IntlCarbon::now()->subHours(2);
        $this->assertSame('hace 2 horas', $d->diffForHumans());

        $d = IntlCarbon::now()->subDay();
        $this->assertSame('hace 1 día', $d->diffForHumans());

        $d = IntlCarbon::now()->subDays(2);
        $this->assertSame('hace 2 días', $d->diffForHumans());

        $d = IntlCarbon::now()->subWeek();
        $this->assertSame('hace 1 semana', $d->diffForHumans());

        $d = IntlCarbon::now()->subWeeks(2);
        $this->assertSame('hace 2 semanas', $d->diffForHumans());

        $d = IntlCarbon::now()->subMonth();
        $this->assertSame('hace 1 mes', $d->diffForHumans());

        $d = IntlCarbon::now()->subMonths(2);
        $this->assertSame('hace 2 meses', $d->diffForHumans());

        $d = IntlCarbon::now()->subYear();
        $this->assertSame('hace 1 año', $d->diffForHumans());

        $d = IntlCarbon::now()->subYears(2);
        $this->assertSame('hace 2 años', $d->diffForHumans());

        $d = IntlCarbon::now()->addSecond();
        $this->assertSame('dentro de 1 segundo', $d->diffForHumans());

        $d = IntlCarbon::now()->addSecond();
        $d2 = IntlCarbon::now();
        $this->assertSame('1 segundo antes', $d->diffForHumans($d2));
        $this->assertSame('1 segundo después', $d2->diffForHumans($d));

        $this->assertSame('1 segundo', $d->diffForHumans($d2, true));
        $this->assertSame('2 segundos', $d2->diffForHumans($d->addSecond(), true));
    }

    public function testDiffForHumansLocalizedInItalian()
    {
        IntlCarbon::setLocale('it');

        $d = IntlCarbon::now()->addYear();
        $this->assertSame('1 anno da adesso', $d->diffForHumans());

        $d = IntlCarbon::now()->addYears(2);
        $this->assertSame('2 anni da adesso', $d->diffForHumans());
    }

    public function testDiffForHumansLocalizedInGerman()
    {
        IntlCarbon::setLocale('de');

        $d = IntlCarbon::now()->addYear();
        $this->assertSame('in 1 Jahr', $d->diffForHumans());

        $d = IntlCarbon::now()->addYears(2);
        $this->assertSame('in 2 Jahren', $d->diffForHumans());

        $d = IntlCarbon::now()->subYear();
        $this->assertSame('1 Jahr später', IntlCarbon::now()->diffForHumans($d));

        $d = IntlCarbon::now()->subYears(2);
        $this->assertSame('2 Jahre später', IntlCarbon::now()->diffForHumans($d));

        $d = IntlCarbon::now()->addYear();
        $this->assertSame('1 Jahr zuvor', IntlCarbon::now()->diffForHumans($d));

        $d = IntlCarbon::now()->addYears(2);
        $this->assertSame('2 Jahre zuvor', IntlCarbon::now()->diffForHumans($d));

        $d = IntlCarbon::now()->subYear();
        $this->assertSame('vor 1 Jahr', $d->diffForHumans());

        $d = IntlCarbon::now()->subYears(2);
        $this->assertSame('vor 2 Jahren', $d->diffForHumans());
    }

    public function testDiffForHumansLocalizedInTurkish()
    {
        IntlCarbon::setLocale('tr');

        $d = IntlCarbon::now()->subSecond();
        $this->assertSame('1 saniye önce', $d->diffForHumans());

        $d = IntlCarbon::now()->subSeconds(2);
        $this->assertSame('2 saniye önce', $d->diffForHumans());

        $d = IntlCarbon::now()->subMinute();
        $this->assertSame('1 dakika önce', $d->diffForHumans());

        $d = IntlCarbon::now()->subMinutes(2);
        $this->assertSame('2 dakika önce', $d->diffForHumans());

        $d = IntlCarbon::now()->subHour();
        $this->assertSame('1 saat önce', $d->diffForHumans());

        $d = IntlCarbon::now()->subHours(2);
        $this->assertSame('2 saat önce', $d->diffForHumans());

        $d = IntlCarbon::now()->subDay();
        $this->assertSame('1 gün önce', $d->diffForHumans());

        $d = IntlCarbon::now()->subDays(2);
        $this->assertSame('2 gün önce', $d->diffForHumans());

        $d = IntlCarbon::now()->subWeek();
        $this->assertSame('1 hafta önce', $d->diffForHumans());

        $d = IntlCarbon::now()->subWeeks(2);
        $this->assertSame('2 hafta önce', $d->diffForHumans());

        $d = IntlCarbon::now()->subMonth();
        $this->assertSame('1 ay önce', $d->diffForHumans());

        $d = IntlCarbon::now()->subMonths(2);
        $this->assertSame('2 ay önce', $d->diffForHumans());

        $d = IntlCarbon::now()->subYear();
        $this->assertSame('1 yıl önce', $d->diffForHumans());

        $d = IntlCarbon::now()->subYears(2);
        $this->assertSame('2 yıl önce', $d->diffForHumans());

        $d = IntlCarbon::now()->addSecond();
        $this->assertSame('1 saniye andan itibaren', $d->diffForHumans());

        $d = IntlCarbon::now()->addSecond();
        $d2 = IntlCarbon::now();
        $this->assertSame('1 saniye sonra', $d->diffForHumans($d2));
        $this->assertSame('1 saniye önce', $d2->diffForHumans($d));

        $this->assertSame('1 saniye', $d->diffForHumans($d2, true));
        $this->assertSame('2 saniye', $d2->diffForHumans($d->addSecond(), true));
    }

    public function testDiffForHumansLocalizedInDanish()
    {
        IntlCarbon::setLocale('da');

        $d = IntlCarbon::now()->subSecond();
        $this->assertSame('1 sekund siden', $d->diffForHumans());

        $d = IntlCarbon::now()->subSeconds(2);
        $this->assertSame('2 sekunder siden', $d->diffForHumans());

        $d = IntlCarbon::now()->subMinute();
        $this->assertSame('1 minut siden', $d->diffForHumans());

        $d = IntlCarbon::now()->subMinutes(2);
        $this->assertSame('2 minutter siden', $d->diffForHumans());

        $d = IntlCarbon::now()->subHour();
        $this->assertSame('1 time siden', $d->diffForHumans());

        $d = IntlCarbon::now()->subHours(2);
        $this->assertSame('2 timer siden', $d->diffForHumans());

        $d = IntlCarbon::now()->subDay();
        $this->assertSame('1 dag siden', $d->diffForHumans());

        $d = IntlCarbon::now()->subDays(2);
        $this->assertSame('2 dage siden', $d->diffForHumans());

        $d = IntlCarbon::now()->subWeek();
        $this->assertSame('1 uge siden', $d->diffForHumans());

        $d = IntlCarbon::now()->subWeeks(2);
        $this->assertSame('2 uger siden', $d->diffForHumans());

        $d = IntlCarbon::now()->subMonth();
        $this->assertSame('1 måned siden', $d->diffForHumans());

        $d = IntlCarbon::now()->subMonths(2);
        $this->assertSame('2 måneder siden', $d->diffForHumans());

        $d = IntlCarbon::now()->subYear();
        $this->assertSame('1 år siden', $d->diffForHumans());

        $d = IntlCarbon::now()->subYears(2);
        $this->assertSame('2 år siden', $d->diffForHumans());

        $d = IntlCarbon::now()->addSecond();
        $this->assertSame('om 1 sekund', $d->diffForHumans());

        $d = IntlCarbon::now()->addSecond();
        $d2 = IntlCarbon::now();
        $this->assertSame('1 sekund efter', $d->diffForHumans($d2));
        $this->assertSame('1 sekund før', $d2->diffForHumans($d));

        $this->assertSame('1 sekund', $d->diffForHumans($d2, true));
        $this->assertSame('2 sekunder', $d2->diffForHumans($d->addSecond(), true));
    }

    public function testDiffForHumansLocalizedInLithuanian()
    {
        IntlCarbon::setLocale('lt');

        $d = IntlCarbon::now()->addYear();
        $this->assertSame('1 metai nuo dabar', $d->diffForHumans());

        $d = IntlCarbon::now()->addYears(2);
        $this->assertSame('2 metai nuo dabar', $d->diffForHumans());
    }

    public function testDiffForHumansLocalizedInKorean()
    {
        IntlCarbon::setLocale('ko');

        $d = IntlCarbon::now()->addYear();
        $this->assertSame('1 년 후', $d->diffForHumans());

        $d = IntlCarbon::now()->addYears(2);
        $this->assertSame('2 년 후', $d->diffForHumans());
    }

    public function testDiffForHumansLocalizedInFarsi()
    {
        IntlCarbon::setLocale('fa');

        $d = IntlCarbon::now()->subSecond();
        $this->assertSame('1 ثانیه پیش', $d->diffForHumans());

        $d = IntlCarbon::now()->subSeconds(2);
        $this->assertSame('2 ثانیه پیش', $d->diffForHumans());

        $d = IntlCarbon::now()->subMinute();
        $this->assertSame('1 دقیقه پیش', $d->diffForHumans());

        $d = IntlCarbon::now()->subMinutes(2);
        $this->assertSame('2 دقیقه پیش', $d->diffForHumans());

        $d = IntlCarbon::now()->subHour();
        $this->assertSame('1 ساعت پیش', $d->diffForHumans());

        $d = IntlCarbon::now()->subHours(2);
        $this->assertSame('2 ساعت پیش', $d->diffForHumans());

        $d = IntlCarbon::now()->subDay();
        $this->assertSame('1 روز پیش', $d->diffForHumans());

        $d = IntlCarbon::now()->subDays(2);
        $this->assertSame('2 روز پیش', $d->diffForHumans());

        $d = IntlCarbon::now()->subWeek();
        $this->assertSame('1 هفته پیش', $d->diffForHumans());

        $d = IntlCarbon::now()->subWeeks(2);
        $this->assertSame('2 هفته پیش', $d->diffForHumans());

        $d = IntlCarbon::now()->subMonth();
        $this->assertSame('1 ماه پیش', $d->diffForHumans());

        $d = IntlCarbon::now()->subMonths(2);
        $this->assertSame('2 ماه پیش', $d->diffForHumans());

        $d = IntlCarbon::now()->subYear();
        $this->assertSame('1 سال پیش', $d->diffForHumans());

        $d = IntlCarbon::now()->subYears(2);
        $this->assertSame('2 سال پیش', $d->diffForHumans());

        $d = IntlCarbon::now()->addSecond();
        $this->assertSame('1 ثانیه بعد', $d->diffForHumans());

        $d = IntlCarbon::now()->addSecond();
        $d2 = IntlCarbon::now();
        $this->assertSame('1 ثانیه پیش از', $d->diffForHumans($d2));
        $this->assertSame('1 ثانیه پس از', $d2->diffForHumans($d));

        $d = IntlCarbon::now()->addSecond();
        $d2 = IntlCarbon::now();
        $this->assertSame('1 ثانیه پیش از', $d->diffForHumans($d2));
        $this->assertSame('1 ثانیه پس از', $d2->diffForHumans($d));

        $this->assertSame('1 ثانیه', $d->diffForHumans($d2, true));
        $this->assertSame('2 ثانیه', $d2->diffForHumans($d->addSecond(), true));
    }
}
