<?php

namespace Ivo\Interface;

interface IntegerInterface extends ScalarInterface
{
    /**
     * Define the minimum range of the integer, if necessary
     *
     * @var int
     */
    # public const INTEGER_MINIMUM_RANGE = -1000;

    /**
     * Define the maximum range of the integer, if necessary
     *
     * @var int
     */
    # public const INTEGER_MAXIMUM_RANGE = 9999;

    /**
     * Raw value getter
     *
     * @return int
     */
    public function value(): int;
}
