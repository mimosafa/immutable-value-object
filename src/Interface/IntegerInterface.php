<?php

namespace Ivo\Interface;

interface IntegerInterface extends ComputableInterface
{
    /**
     * Raw value getter
     *
     * @return int
     */
    public function value(): int;
}
