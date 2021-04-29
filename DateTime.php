<?php

namespace Codememory\Components\DateTime;

use DateInterval;
use DateTime as ReservedDateTime;
use Codememory\Components\DateTime\Exceptions\InvalidTimezoneException;
use Codememory\Components\DateTime\Interfaces\DateTimeInterface;

/**
 * Class DateTime
 * @package System\Support\DateTime
 *
 * @author  Codememory
 */
class DateTime extends Timezone implements DateTimeInterface
{

    /**
     * @var DateInterval|ReservedDateTime|null
     */
    protected null|ReservedDateTime|DateInterval $datetime = null;

    /**
     * @var string
     */
    private string $modifyOperator = '+';

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Get a reserved DateTime with configured timezone
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string|null $date
     *
     * @return ReservedDateTime|DateInterval
     * @throws InvalidTimezoneException
     * @throws \Exception
     */
    protected function datetime(?string $date = null): ReservedDateTime|DateInterval
    {

        if (null === $this->datetime) {
            $datetime = new ReservedDateTime($date, $this->getTimezone());

            return $datetime->setTimezone($this->getTimezone());
        }

        return $this->datetime;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Set the default date from which further actions will be taken. If you
     * & only pass the first argument, then you can put the date and time in it
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string|null $date
     * @param int         $day
     * @param int         $month
     * @param int         $year
     *
     * @return $this
     * @throws InvalidTimezoneException
     */
    public function setDate(?string $date = null, int $day = 1, int $month = 0, int $year = 0): DateTime
    {

        $this->datetime = $this->datetime($date);

        if (null === $date) {
            $this->datetime = $this->datetime->setDate($year, $month, $day);
        }

        return $this;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Add time to date by default. You can also pass the full date to
     * & timestamp, for this you need to add seconds to the $second argument
     * & and set the $timestamp argument to true
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param int $hour
     * @param int $minute
     * @param int $second
     *
     * @return $this
     * @throws InvalidTimezoneException
     */
    public function setTime(int $hour = 0, int $minute = 0, int $second = 0): DateTime
    {

        $this->datetime = $this->datetime()->setTime($hour, $minute, $second);

        return $this;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & The main method for adding or subtracting days, etc. from a date
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param int    $number
     * @param string $type
     *
     * @return DateTime
     * @throws InvalidTimezoneException
     */
    private function adderOrSubtraction(int $number, string $type): DateTime
    {

        $this->datetime = $this
            ->datetime()
            ->modify(sprintf('%s%s %s', $this->modifyOperator, $number, $type));

        return $this;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Overridden modify method of a reserved DateTime object
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $modify
     *
     * @return $this
     * @throws InvalidTimezoneException
     */
    public function modify(string $modify): DateTime
    {

        $this->datetime = $this->datetime()->modify($modify);

        return $this;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & This method indicates that the following method executions are years,
     * & days and other methods that add or subtract. Will be performed as an addition
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return DateTime
     */
    public function addTime(): DateTime
    {

        $this->modifyOperator = '+';

        return $this;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Add/Subtract years from date or timestamp
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param int $number
     *
     * @return DateTime|Time
     * @throws InvalidTimezoneException
     */
    public function years(int $number): DateTime|Time
    {

        return $this->adderOrSubtraction($number, 'year');

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Add/Subtract months from date or timestamp
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param int $number
     *
     * @return DateTime|Time
     * @throws InvalidTimezoneException
     */
    public function months(int $number): DateTime|Time
    {

        return $this->adderOrSubtraction($number, 'month');


    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Add/Subtract weeks from date or timestamp
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param int $number
     *
     * @return DateTime|Time
     * @throws InvalidTimezoneException
     */
    public function weeks(int $number): DateTime|Time
    {

        return $this->adderOrSubtraction($number, 'week');

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Add/Subtract days from date or timestamp
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param int $number
     *
     * @return DateTime|Time
     * @throws InvalidTimezoneException
     */
    public function days(int $number): DateTime|Time
    {

        return $this->adderOrSubtraction($number, 'day');

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Add/Subtract hours from date or timestamp
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param int $number
     *
     * @return DateTime|Time
     * @throws InvalidTimezoneException
     */
    public function hours(int $number): DateTime|Time
    {

        return $this->adderOrSubtraction($number, 'hour');

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Add/Subtract minutes from date or timestamp
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param int $number
     *
     * @return DateTime|Time
     * @throws InvalidTimezoneException
     */
    public function minutes(int $number): DateTime|Time
    {

        return $this->adderOrSubtraction($number, 'minute');

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Add/Subtract seconds from date or timestamp
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param int $number
     *
     * @return DateTime|Time
     * @throws InvalidTimezoneException
     */
    public function seconds(int $number): DateTime|Time
    {

        return $this->adderOrSubtraction($number, 'second');

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Get the current date with the default format Y-m-d H: i: s. In order
     * & to specify a different format, you need to pass the format as an argument
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return int|string
     * @throws InvalidTimezoneException
     */
    public function now(): int|string
    {

        $format = func_num_args() > 0 ? func_get_arg(0) : 'Y-m-d H:i:s';

        return $this->datetime('now')->format($format);

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & The method indicates that the next added methods "years" and the
     * & like will not be added to the date, but will be subtracted
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return $this
     */
    public function subTime(): DateTime
    {

        $this->modifyOperator = '-';

        return $this;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & The method splits the date according to the specified format in the
     * & first argument
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $format
     * @param string $date
     *
     * @return $this
     * @throws InvalidTimezoneException
     */
    public function splitByFormat(string $format, string $date): DateTime
    {

        $this->datetime = $this->datetime()->createFromFormat($format, $date);

        return $this;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & The method calculates the difference between two dates
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $compare
     * @param string $target
     *
     * @return $this
     * @throws InvalidTimezoneException
     */
    public function diff(string $compare, string $target): DateTime
    {

        $origin = $this->datetime($compare);
        $target = $this->datetime($target);

        $this->datetime = $origin->diff($target);

        return $this;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Returns the date formatted according to the given format
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $format
     *
     * @return string
     * @throws InvalidTimezoneException
     * @throws \Exception
     */
    public function format(string $format): string
    {

        $date = $this->datetime()->format($format);
        $this->datetime = null;

        return $date;

    }

}