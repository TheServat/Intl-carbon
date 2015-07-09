<?php namespace IntlCarbon;

use Carbon\Carbon;
use DatePeriod;
use DateTime;
use DateTimeZone;
use InvalidArgumentException;
use NumberFormatter;
use Carbon\CarbonInterval;
use Closure;


class IntlCarbon extends Carbon
{
    /**
     * @var string The current calendar in use
     */
    protected $calendar = 'gregorian';

    /**
     * @var Overwrite the calendar on all objects
     */
    protected static $_all_calendar = null;

    /**
     * @var string The current locale in use
     */
    protected $_locale = 'en_US';

    /**
     * @var Overwrite the locale on all objects
     */
    protected static $_all_locale = null;

    /**
     * @var bool format must return latin digits
     */
    private $__latinaze = false;

    /**
     * Sets the calendar used by the object.
     *
     * @param string $calendar
     */
    public function setCalendar($calendar)
    {
        $this->calendar = strtolower($calendar);
        return $this;
    }

    /**
     * Sets the calendar used by the all objects.
     *
     * @param string $calendar
     */
    public static function setAllCalendar($calendar)
    {
        static::$_all_calendar = strtolower($calendar);
    }

    /**
     * Gets the current calendar used by the object.
     *
     * @return string
     */
    public function getCalendar()
    {
        if(static::$_all_calendar !== null)
            return static::$_all_calendar;
        return $this->calendar;
    }

    /**
     * Sets the locale used by the object.
     *
     * @param string $locale
     */
    public function setLang($locale)
    {
        $this->_locale = $locale;
        return $this;
    }
    /**
     * Sets the locale of all objects.
     *
     * @param string $locale
     */
    public static function setAllLang($locale)
    {
        static::$_all_locale = $locale;
    }

    /**
     * Gets the current locale used by the object.
     *
     * @return string
     */
    public function getLang()
    {
        if(static::$_all_locale !== null){
            return static::$_all_locale;
        }
            return $this->_locale;
    }

    /**
     * Returns an instance of IntlDateFormatter with specified options.
     *
     * @param array $options
     * @return PhpIntlDateFormatter
     */
    protected function getFormatter($options = array())
    {
        $locale = empty($options['locale']) ? $this->getLang() : $options['locale'];
        $calendar = empty($options['calendar']) ? $this->getCalendar() : $options['calendar'];
        $timezone = empty($options['timezone']) ? $this->getTimezone() : $options['timezone'];
        if (is_a($timezone, 'DateTimeZone')) $timezone = $timezone->getName();
        $pattern = empty($options['pattern']) ? null : $options['pattern'];
        return new Formatter($locale . '@calendar=' . $calendar,
            Formatter::FULL, Formatter::FULL, $timezone,
            $calendar == 'gregorian' ? Formatter::GREGORIAN : Formatter::TRADITIONAL, $pattern);
    }

    /**
     * Returns date formatted according to given pattern.
     *
     * @param string $pattern Date pattern in ICU syntax (@link http://userguide.icu-project.org/formatparse/datetime)
     * @param mixed $timezone DateTimeZone object or timezone identifier as full name (e.g. Asia/Tehran) or abbreviation (e.g. IRDT).
     * @return string Formatted date on success or FALSE on failure.
     */
    public function format($pattern)
    {
        if(!extension_loaded('intl')){
            return parent::format($pattern);
        }
        $classicPattern = array(
            //Timezone
//            'e' => '+++!+++',    // Timezone identifier. Examples: UTC, GMT, Atlantic/Azores
            'I' => '+++!!+++',      // Whether or not the date is in daylight saving time, 1 if Daylight Saving Time, 0 otherwise.
//            'O' => '+++!!!+++',    // Difference to Greenwich time (GMT) in hours, Example: +0200
//            'P' => '+++!!!!+++',   // Difference to Greenwich time (GMT) with colon between hours and minutes, Example: +02:00
            '\T' => '\T',
            'T' => '+++!!!!!+++',   // Timezone abbreviation, Examples: EST, MDT ...
//            'Z' => '+++!!!!!!+++',    // Timezone offset in seconds. The offset for timezones west of UTC is always negative, and for those east of UTC is always positive. -43200 through 50400
            // Time
            'u' => '+++!!!!!!!+++' // Microseconds. Example: 654321
        );

        $pattern = strtr($pattern, $classicPattern);

        // Timezones DST data in ICU are not as accurate as PHP.
        // So we get timezone offset from php and pass it to ICU.
        $result = $this->getFormatter(array(
            'timezone' => 'GMT' . (parent::format('Z') ? parent::format('P') : ''),
            'pattern' => $pattern
        ))->format($this->getTimestamp());
        foreach ($classicPattern as $key => $pat) {
            $result = str_replace($pat, parent::format($key), $result);
        }
        if($this->__latinaze){
            return $this->latinizeDigits($result);
        }
        return $result;
    }


    /**
     * Overrides the getTimestamp method to support timestamps out of the integer range.
     *
     * @return float Unix timestamp representing the date.
     */
    public function getTimestamp()
    {
        return (float)parent::format('U');
    }

    /**
     * Overrides the setTimestamp method to support timestamps out of the integer range.
     *
     * @param float $unixtimestamp Unix timestamp representing the date.
     * @return IntlCarbon the modified DateTime.
     */
    public function setTimestamp($unixtimestamp)
    {
        $diff = $unixtimestamp - $this->getTimestamp();
        $days = floor($diff / 86400);
        $seconds = $diff - $days * 86400;
        $timezone = $this->getTimezone();
        $this->setTimezone('UTC');
        parent::modify("$days days $seconds seconds");
        $this->setTimezone($timezone);
        return $this;
    }

    /**
     * Alter the timestamp by incrementing or decrementing in a format accepted by strtotime().
     *
     * @param string $modify a string in a relative format accepted by strtotime().
     * @return IntlDateTime The modified DateTime.
     */
    public function modify($modify)
    {
        //TODO:: support weekday,week
        $modify = $this->latinizeDigits(trim($modify));
        $modify = preg_replace_callback('/(.*?)((?:[+-]?\d+)|next|last|previous)\s*(year|month)s?/i', array($this, 'modifyCallback'), $modify);
        if ($modify) parent::modify($modify);
        return $this;
    }

    /**
     * Internally used by modify method to calculate calendar-aware modifications
     *
     * @param array $matches
     * @return string An empty string
     */
    protected function modifyCallback($matches)
    {
        if (!empty($matches[1])) {
            parent::modify($matches[1]);
        }

        list($y, $m, $d) = explode('-', $this->format('Y-n-j'));
        $change = strtolower($matches[2]);
        $unit = strtolower($matches[3]);

        switch ($change) {
            case "next":
                $change = 1;
                break;

            case "last":
            case "previous":
                $change = -1;
                break;
        }

        switch ($unit) {
            case "month":
                $m += $change;
                if ($m > 12) {
                    $y += floor($m / 12);
                    $m = $m % 12;
                } elseif ($m < 1) {
                    $y += ceil($m / 12) - 1;
                    $m = $m % 12 + 12;
                }
                break;

            case "year":
                $y += $change;
                break;
        }

        $this->setDate($y, $m, $d);

        return '';
    }

    /**
     * Resets the current date of the object.
     *
     * @param integer $year
     * @param integer $month
     * @param integer $day
     * @return IntlCarbon The modified DateTime.
     */
    public function setDate($year, $month, $day)
    {
        $this->set("$year/$month/$day " . $this->format('H:i:s'), null, 'Y/n/j H:i:s');
        return $this;
    }

    /**
     * Alters object's internal timestamp with a string acceptable by strtotime() or a Unix timestamp or a DateTime object.
     *
     * @param mixed $time Unix timestamp or strtotime() compatible string or another DateTime object
     * @param mixed $timezone DateTimeZone object or timezone identifier as full name (e.g. Asia/Tehran) or abbreviation (e.g. IRDT).
     * @param string $pattern the date pattern in which $time is formatted.
     * @return IntlCarbon The modified DateTime.
     */
    public function set($time, $timezone = null, $pattern = null)
    {
        if (is_a($time, 'DateTime')) {
            $time = $time->format('U');
        } elseif (!is_numeric($time) || $pattern) {
            if (!$pattern && preg_match('/((?:[+-]?\d+)|next|last|previous)\s*(year|month|day)s?/i', $time)) {
                if (isset($timezone)) {
                    $tempTimezone = $this->getTimezone();
                    $this->setTimezone($timezone);
                }

                $this->setTimestamp(time());
                $this->modify($time);

                if (isset($timezone)) {
                    $this->setTimezone($tempTimezone);
                }

                return $this;
            }
            $timezone = empty($timezone) ? $this->getTimezone() : $timezone;
            if (is_a($timezone, 'DateTimeZone')) $timezone = $timezone->getName();
            $defaultTimezone = @date_default_timezone_get();
            date_default_timezone_set($timezone);

            if ($pattern) {
                $time = $this->getFormatter(array('timezone' => 'GMT', 'pattern' => $pattern))->parse($time);
                $time -= date('Z', $time);
            } else {
                $time = strtotime($time);
            }

            date_default_timezone_set($defaultTimezone);
        }

        $this->setTimestamp($time);

        return $this;
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
        $num = new NumberFormatter($this->getLang(), NumberFormatter::DECIMAL);
        preg_match_all('/.[\x80-\xBF]*/', $str, $matches);
        foreach ($matches[0] as $char) {
            $pos = 0;
            $parsedChar = $num->parse($char, NumberFormatter::TYPE_INT32, $pos);
            $result .= $pos ? $parsedChar : $char;
        }
        return $result;
    }

    /**
     * Get the difference in seconds
     *
     * @param Carbon $dt
     * @param boolean $abs Get the absolute of the difference
     *
     * @return integer
     */
    public function diffInSeconds(Carbon $dt = null, $abs = true)
    {
        $dt = ($dt === null) ? static::now($this->tz) : $dt;
        $value = (int)$dt->getTimestamp() - (int)$this->getTimestamp();

        return $abs ? abs($value) : $value;
    }


    /**
     * Get the difference by the given interval using a filter closure
     *
     * @param CarbonInterval $ci An interval to traverse by
     * @param Closure $callback
     * @param Carbon $dt
     * @param boolean $abs Get the absolute of the difference
     *
     * @return int
     */
    public function diffFiltered(CarbonInterval $ci, Closure $callback, IntlCarbon $dt = null, $abs = true)
    {
        $start = $this;
        $end = ($dt === null) ? static::now($this->tz) : $dt;
        $inverse = false;

        if ($end < $start) {
            $start = $end;
            $end = $this;
            $inverse = true;
        }

        $period = new DatePeriod($start, $ci, $end);
        $vals = array_filter(iterator_to_array($period), function (DateTime $date) use ($callback) {
            return call_user_func($callback, IntlCarbon::instance($date));
        });

        $diff = count($vals);

        return $inverse && !$abs ? -$diff : $diff;
    }

    /**
     * Get a part of the Carbon object
     *
     * @param string $name
     *
     * @throws InvalidArgumentException
     *
     * @return string|integer|DateTimeZone
     */
    public function __get($name)
    {
        $formatter = $this->getFormatter(array(
            'timezone' => 'GMT' . (parent::format('Z') ? parent::format('P') : '')
        ));
        switch (true) {
            case $name === 'timestamp':
                return (int)$this->latinizeDigits($this->getTimestamp());
            case $name === 'weekOfMonth':
                $formatter->setPattern('W');
                return (int)$this->latinizeDigits($this->format('C'));

            case $name === 'quarter':
                $formatter->setPattern('q');
                return (int)$this->latinizeDigits($formatter->classicFormat($this->getTimestamp()));
            default:
                $this->__latinaze = true;
                $result = parent::__get($name);
                $this->__latinaze = false;
                return $result;
        }
    }

    /**
     * Set a part of the Carbon object
     *
     * @param string $name
     * @param string|integer|DateTimeZone $value
     *
     * @throws InvalidArgumentException
     */
    public function __set($name, $value)
    {
        if(is_string($value)){
            $value = $this->latinizeDigits($value);
        }
        return parent::__set($name,$value);
    }
}