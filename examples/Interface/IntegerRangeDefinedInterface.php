<?php

namespace Ivo\Example\Interface;

use Ivo\Interface\IntegerInterface;

interface IntegerRangeDefinedInterface extends IntegerInterface
{
    public const INTEGER_MINIMUM_RANGE = 0;
    public const INTEGER_MAXIMUM_RANGE = 255;
}
