<?php namespace IntlCarbon;

use DateTime;
use DateTimeZone;
use IntlCalendar;
use NumberFormatter;
use IntlDateFormatter;
class Formatter extends IntlDateFormatter
{
    protected static $convertPattern = [
        '\d' => '\'d\'',
        '\D' => '\'D\'',
        '\j' => '\'j\'',
        '\l' => '\'l\'',
        '\N' => '\'N\'',
        '\S' => '\'S\'',
        '\w' => '\'w\'',
        '\z' => '\'z\'',
        '\W' => '\'W\'',
        '\F' => '\'F\'',
        '\m' => '\'m\'',
        '\M' => '\'M\'',
        '\n' => '\'n\'',
        '\t' => '\'t\'',
        '\L' => '\'L\'',
        '\o' => '\'o\'',
        '\Y' => '\'Y\'',
        '\y' => '\'y\'',
        '\a' => '\'a\'',
        '\A' => '\'A\'',
        '\B' => '\'B\'',
        '\g' => '\'g\'',
        '\G' => '\'G\'',
        '\h' => '\'h\'',
        '\H' => '\'H\'',
        '\i' => '\'i\'',
        '\s' => '\'s\'',
        '\u' => '\'u\'',
        '\e' => '\'e\'',
        '\I' => '\'I\'',
        '\O' => '\'O\'',
        '\P' => '\'P\'',
        '\T' => '\'T\'',
        '\Z' => '\'Z\'',
        '\c' => '\'c\'',
        '\r' => '\'r\'',
        '\U' => '\'U\'',
        '\q' => '\'q\'',
        '\f' => '\'f\'',
        'V' => '\'V\'',
        'x' => '\'x\'',

        'd' => 'dd',    // Day of the month, 2 digits with leading zeros 	01 to 31
        'D' => 'eee',   // A textual representation of a day, three letters 	Mon through Sun
        'j' => 'd',     // Day of the month without leading zeros 	1 to 31
        'l' => 'eeee',  // A full textual representation of the day of the week 	Sunday through Saturday
        'N' => 'e',     // ISO-8601 numeric representation of the day of the week, 1 (for Monday) through 7 (for Sunday)
        'S' => '{{S}}',      // English ordinal suffix for the day of the month, 2 characters 	st, nd, rd or th. Works well with j
        'w' => '{{w}}',      // Numeric representation of the day of the week 	0 (for Sunday) through 6 (for Saturday)
        'z' => '{{z}}',     // The day of the year (starting from 0) 	0 through 365
        // Week
        'W' => '{{W}}',     // ISO-8601 week number of year, weeks starting on Monday (added in PHP 4.1.0) 	Example: 42 (the 42nd week in the year)
        // Month
        'F' => 'MMMM',  // A full textual representation of a month, January through December
        'm' => 'MM',    // Numeric representation of a month, with leading zeros 	01 through 12
        'M' => 'MMM',   // A short textual representation of a month, three letters 	Jan through Dec
        'n' => 'M',     // Numeric representation of a month, without leading zeros 	1 through 12, not supported by ICU but we fallback to "with leading zero"
        't' => '{{t}}',      // Number of days in the given month 	28 through 31
        // Year
        'L' => '{{L}}',      // Whether it's a leap year, 1 if it is a leap year, 0 otherwise.
        'o' => 'Y',     // ISO-8601 year number. This has the same value as Y, except that if the ISO week number (W) belongs to the previous or next year, that year is used instead.
        'Y' => 'yyyy',  // A full numeric representation of a year, 4 digits 	Examples: 1999 or 2003
        'y' => 'yy',    // A two digit representation of a year 	Examples: 99 or 03
        // Time
        'a' => '{{a}}',     // Lowercase Ante meridiem and Post meridiem, am or pm
        'A' => '{{A}}',     // Uppercase Ante meridiem and Post meridiem, AM or PM, not supported by ICU but we fallback to lowercase
        'B' => '{{B}}',      // Swatch Internet time 	000 through 999
        'g' => 'h',     // 12-hour format of an hour without leading zeros 	1 through 12
        'G' => 'H',     // 24-hour format of an hour without leading zeros 0 to 23h
        'h' => 'hh',    // 12-hour format of an hour with leading zeros, 01 to 12 h
        'H' => 'HH',    // 24-hour format of an hour with leading zeros, 00 to 23 h
        'i' => 'mm',    // Minutes with leading zeros 	00 to 59
        's' => 'ss',    // Seconds, with leading zeros 	00 through 59
        'u' => '{{u}}',      // Microseconds. Example: 654321
        // Timezone
        'e' => 'VV',    // Timezone identifier. Examples: UTC, GMT, Atlantic/Azores
        'I' => '{{I}}',      // Whether or not the date is in daylight saving time, 1 if Daylight Saving Time, 0 otherwise.
        'O' => 'xx',    // Difference to Greenwich time (GMT) in hours, Example: +0200
        'P' => 'xxx',   // Difference to Greenwich time (GMT) with colon between hours and minutes, Example: +02:00
        'T' => 'zzz',   // Timezone abbreviation, Examples: EST, MDT ...
        'Z' => '{{Z}}',    // Timezone offset in seconds. The offset for timezones west of UTC is always negative, and for those east of UTC is always positive. -43200 through 50400
        // Full Date/Time
        'c' => 'yyyy-MM-dd\'T\'HH:mm:ssxxx', // ISO 8601 date, e.g. 2004-02-12T15:19:21+00:00
        'r' => 'eee, dd MMM yyyy HH:mm:ss xx', // RFC 2822 formatted date, Example: Thu, 21 Dec 2000 16:01:07 +0200
        'U' => '{{U}}',      // Seconds since the Unix Epoch (January 1 1970 00:00:00 GMT)
        'C' => '{{C}}', // Week Of Month
        'q' => 'W' // Week of Month
    ];

    protected static function convertToIcu($pattern)
    {
        $pattern = str_replace('\'\'', '', strtr($pattern, static::$convertPattern));
        $pattern = preg_replace_callback('/\\\(.)/i', function ($a) {
            return '\'' . $a[1] . '\'';
        }, $pattern);
        return $pattern;
    }

    public function parse($value, &$position = null)
    {
        $tmpPattern = $this->getPattern();
        $pattern = static::convertToIcu($tmpPattern);
        if (preg_match_all('/\{\{(.)\}\}/', $pattern, $cPatterns)) {
            $pattern = preg_replace('/\{\{(.)\}\}/','',$pattern);
            return false; //TODO: CustomParser
        }
        $this->setPattern($pattern);
        $result = parent::parse($value, $position);
        $this->setPattern($tmpPattern);

        return $result;
    }

    public function classicFormat($value)
    {
        return parent::format($value);
    }

    public function format($value)
    {

        $datetime = $this->GetDateTimeFromTimeStamp($value);

        $tmpPattern = $this->getPattern();
        $pattern = static::convertToIcu($tmpPattern);
        preg_match_all('/\{\{(.)\}\}/', $pattern, $cPatterns);
        $pattern = preg_replace('/\{\{.\}\}/', '_!!!_', $pattern);
        $this->setPattern($pattern);
        $result = parent::format($value);
        $cPatternIndex = -1;
        $result = preg_replace_callback('/_\!\!\!_/', function ($match) use ($cPatterns, &$cPatternIndex, $datetime) {
            $cPatternIndex++;
            return $this->resolveCustomPattern($cPatterns[1][$cPatternIndex], $datetime);
        }, $result);
        $this->setPattern($tmpPattern);
        return $this->localizeDigits($result);
    }

    /**
     * @param $pattern
     * @param DateTime $datetime
     * @return mixed
     */
    protected function resolveCustomPattern($pattern, $datetime)
    {
        $calendar = $this->getCalendarFromDateTime($datetime);
        if ($pattern == 'S') {
            $day = $calendar->get(IntlCalendar::FIELD_DAY_OF_MONTH);
            return $this->localizeOrdinal($day);
        }
        if ($pattern == 'w') {
            return $calendar->get(IntlCalendar::FIELD_DAY_OF_WEEK) - 1;
        }
        if ($pattern == 't') {
            return $calendar->getActualMaximum(IntlCalendar::FIELD_DAY_OF_MONTH) ;
        }
        if ($pattern == 'I') {
            return $calendar->getTimeZone()->useDaylightTime() ? '1' : '0';
        }

        if ($pattern == 'A') {
            $tmpPattern = $this->getPattern();
            $this->setPattern('a');
            $value = $this->classicFormat($calendar);
            $this->setPattern($tmpPattern);
            return strtoupper($value);
        }

        if ($pattern == 'z') {
            return $calendar->get(IntlCalendar::FIELD_DAY_OF_YEAR) - 1;
        }
        if ($pattern == 'C') {
            $tmpFirstDay = $calendar->getFirstDayOfWeek();
            if ($this->getCalendar() == IntlPhpDateFormater::GREGORIAN) {
                $calendar->setFirstDayOfWeek(IntlCalendar::DOW_MONDAY);
            }
            $result = $calendar->get(IntlCalendar::FIELD_WEEK_OF_MONTH);
            $calendar->setFirstDayOfWeek($tmpFirstDay);
            return $result;
        }
        if ($pattern == 'W') {
            $tmpCalendar = $this->getCalendarObject();
            $tmpCalendar->set($calendar->get(IntlCalendar::FIELD_YEAR), $calendar->getActualMinimum(IntlCalendar::FIELD_MONTH), 1);
            $tmpFirstDay = $calendar->getFirstDayOfWeek();
            if ($this->getCalendar() == IntlPhpDateFormater::GREGORIAN) {
                $tmpCalendar->setFirstDayOfWeek(IntlCalendar::DOW_MONDAY);
                $calendar->setFirstDayOfWeek(IntlCalendar::DOW_MONDAY);
            }
            $subWeek = false;
            if ($tmpCalendar->get(IntlCalendar::FIELD_DAY_OF_WEEK) < $calendar->getFirstDayOfWeek()) {
                $subWeek = true;
            }
            $result = $calendar->get(IntlCalendar::FIELD_WEEK_OF_YEAR) - ($subWeek ? 1 : 0);
            $calendar->setFirstDayOfWeek($tmpFirstDay);
            if ($result == 0) {
                //is end of year
                if ($calendar->get(IntlCalendar::FIELD_MONTH) == 11) {
                    $tmpCalendar->set($calendar->get(IntlCalendar::FIELD_YEAR), $calendar->getActualMaximum(IntlCalendar::FIELD_MONTH));
                    $tmpCalendar->set($tmpCalendar->get(IntlCalendar::FIELD_YEAR), $calendar->get(IntlCalendar::FIELD_MONTH), $tmpCalendar->getActualMaximum(IntlCalendar::FIELD_DAY_OF_MONTH));
                    $result = $tmpCalendar->get(IntlCalendar::FIELD_WEEK_OF_YEAR);
                } //is first of year
                else {
                    $tmpCalendar->set($calendar->get(IntlCalendar::FIELD_YEAR) - 1, $calendar->getActualMaximum(IntlCalendar::FIELD_MONTH));
                    $result = $tmpCalendar->getActualMaximum(IntlCalendar::FIELD_WEEK_OF_YEAR) - ($subWeek ? 1 : 0);
                }
            }
            return str_pad('' . $result, 2, '0', STR_PAD_LEFT);
        }
        // L B u Z U
        return $datetime->format($pattern);
    }

    /**
     * localized Ordinal.
     *
     * @param string $str
     * @return string localized Ordinal
     */
    protected function localizeOrdinal($str)
    {
        $num = new  NumberFormatter($this->getLocale(), NumberFormatter::ORDINAL);
        $ord = new NumberFormatter($this->getLocale(), NumberFormatter::DECIMAL);
        return str_replace($ord->format($str), '', $num->format($str));
    }

    /**
     * Replaces localized digits in $str with latin digits.
     *
     * @param string $str
     * @return string Latinized string
     */
    protected function latinizeDigits($str)
    {
        $result = '';
        $num = new NumberFormatter($this->locale, NumberFormatter::DECIMAL);
        preg_match_all('/.[\x80-\xBF]*/', $str, $matches);
        foreach ($matches[0] as $char) {
            $pos = 0;
            $parsedChar = $num->parse($char, NumberFormatter::TYPE_INT32, $pos);

            $result .= $pos ? $parsedChar : $char;
        }
        return $result;
    }

    /**
     * Replaces latin digits in $str with localized digits.
     *
     * @param string $str
     * @return string localized string
     */
    protected function localizeDigits($str)
    {
        $num = new NumberFormatter($this->getLocale(), NumberFormatter::IGNORE);
        return preg_replace_callback('/[0-9]+/', function ($match) use ($num) {
            $result = '';
            if (strlen($match[0]) > 1 && substr($match[0], 0, 1) == '0') {
                $result = $num->format(0);
            }
            return $result . $num->format($match[0]);
        }, $str);

    }

    /**
     * @param $value
     * @return mixed
     */
    protected function GetDateTimeFromTimeStamp($value)
    {
        $calendar = $this->getCalendarObject();
        $datetime = $calendar->toDateTime();
        $diff = $value - $datetime->getTimestamp();
        $days = floor($diff / 86400);
        $seconds = $diff - $days * 86400;
        $timezone = $datetime->getTimezone();
        $datetime->setTimezone(new DateTimeZone('UTC'));
        $datetime->modify("$days days $seconds seconds");
        $datetime->setTimezone($timezone);
        return $datetime;
    }

    /**
     * @param DateTime $datetime
     * @return IntlCalendar
     */
    protected function getCalendarFromDateTime($datetime)
    {
        $calendar = $this->getCalendarObject();
//        $c = IntlCarbon::createFromTimestamp($datetime->format('U'),$datetime->getTimezone());
//        $c->setCalendar($calendar->getType());
        $c = IntlCarbon::instance($datetime);
//        var_dump($c);
//        var_dump($datetime);
//        $calendar->setTime($datetime->format('U'));
//        $calendar->set($datetime->format('Y'), $datetime->format('n') - 1, $datetime->format('d'),
//            $datetime->format('G'), $datetime->format('i'), $datetime->format('s'));
        $calendar->set($c->format('Y'), $c->format('n') - 1, $c->format('d'),
            $c->format('G'), $c->format('i'), $c->format('s'));
        return $calendar;
    }

}