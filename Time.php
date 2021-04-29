<?php

namespace Codememory\Components\DateTime;

use Codememory\Components\DateTime\Exceptions\InvalidTimezoneException;
use Codememory\Components\DateTime\Interfaces\DateTimeInterface;

/**
 * Class Time
 * @package System\Support\DateTime
 *
 * @author  Codememory
 */
class Time extends DateTime implements DateTimeInterface
{

    private const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Returns a date in a timestamp
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return int
     * @throws InvalidTimezoneException
     */
    public function get(): int
    {

        return strtotime(
            $this->format(self::DATE_FORMAT)
        );

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Returns the current date at a timestamp
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return int
     * @throws InvalidTimezoneException
     */
    public function now(): int
    {

        return strtotime(
            parent::now(self::DATE_FORMAT)
        );

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>
     * & Set timestamp time
     * <=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param int $second
     *
     * @return $this
     * @throws InvalidTimezoneException
     */
    public function setTimestamp(int $second): DateTime
    {

        $this->datetime = $this->datetime()->setTimestamp($second);

        return $this;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Get the number of seconds from the duration.
     * & For example, 2 days and 10 minutes = 173400s
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return int
     * @throws InvalidTimezoneException
     */
    public function durationToSeconds(): int
    {

        return $this->get() - $this->now();

    }

}