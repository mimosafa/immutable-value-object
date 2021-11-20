<?php

namespace Ivo\Interface;

interface IntegerInterface extends ScalarInterface
{
    /**
     * Define the minimum range of the integer, if necessary
     *
     * @var int
     */
    # public const MINIMUM = -1000;

    /**
     * Define the maximum range of the integer, if necessary
     *
     * @var int
     */
    # public const MAXIMUM = 9999;

    /**
     * Raw value getter
     *
     * @return int
     */
    public function value(): int;
}
