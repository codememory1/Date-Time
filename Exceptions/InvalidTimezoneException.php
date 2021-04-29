<?php

namespace Codememory\Components\DateTime\Exceptions;

use ErrorException;
use JetBrains\PhpStorm\Pure;

/**
 * Class InvalidTimezoneException
 * @package System\Support\Exceptions\DateTime
 *
 * @author  Codememory
 */
class InvalidTimezoneException extends ErrorException
{

    /**
     * @var string|null
     */
    private ?string $timezone;

    /**
     * InvalidTimezoneException constructor.
     *
     * @param string|null $timezone
     */
    #[Pure] public function __construct(?string $timezone)
    {

        $this->timezone = $timezone;

        parent::__construct(sprintf(
            'The time zone is incorrect. Currently the temporary zone is: %s',
            $this->timezone
        ));

    }

    /**
     * @return string|null
     */
    public function getTimezone(): ?string
    {

        return $this->timezone;

    }

}