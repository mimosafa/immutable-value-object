<?php

namespace Ivo\Interface;

interface IntegerInterface extends ComputableInterface
{
    /**
     * Get an integer value
     *
     * @return int
     */
    public function value(): int;
}
