<?php

namespace Codememory\Components\DateTime;

use DateTimeZone;
use Exception;
use Codememory\Components\DateTime\Exceptions\InvalidTimezoneException;

/**
 * Class Timezone
 * @package System\Support\DateTime
 *
 * @author  Codememory
 */
class Timezone
{

    private const DEFAULT_TIMEZONE = 'GMT';

    /**
     * @var string|null
     */
    protected ?string $timezone = null;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Set the time zone for correct work with date and time. By default,
     * & the time zone is taken from .env[APP_TIMEZONE]
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $timezone
     *
     * @return $this
     */
    public function timezone(string $timezone): Timezone
    {

        $this->timezone = $timezone;

        return $this;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * & Get the currently set timezone
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return DateTimeZone|$this
     * @throws InvalidTimezoneException
     */
    public function getTimezone(): DateTimeZone|Timezone
    {

        $timezone = $this->timezone ?? env('app.timezone') ?: self::DEFAULT_TIMEZONE;

        try {
            return new DateTimeZone($timezone);
        } catch (Exception) {
            $this->catchTimezoneError($timezone);
        }

        return $this;
    }

    /**
     * @param string|null $timezone
     *
     * @throws InvalidTimezoneException
     */
    private function catchTimezoneError(?string $timezone): void
    {

        throw new InvalidTimezoneException($timezone ?? 'null');

    }


}