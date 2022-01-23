<?php

namespace Ivo\Interface;

interface ComputableInterface extends ScalarInterface
{
    # const GREATER_THAN_OR_EQUAL_TO = 0;

    # const GREATER_THAN = 0;

    # const LESS_THAN = 10;

    # const LESS_THAN_OR_EQUAL_TO = 10;

    /**
     * Get a scalar value
     *
     * @return integer|float
     */
    public function value(): int|float;
}
