<?php

namespace Codememory\Components\DateTime\Interfaces;

/**
 * Interface DateTimeInterface
 * @package System\Support\DateTime
 *
 * @author  Codememory
 */
interface DateTimeInterface
{

    /**
     * @return int|string
     */
    public function now(): int|string;

}