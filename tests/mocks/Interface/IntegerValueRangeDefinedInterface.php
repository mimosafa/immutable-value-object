<?php

namespace Ivo\Mock\Interface;

use Ivo\Interface\IntegerValueInterface;

interface IntegerValueRangeDefinedInterface extends IntegerValueInterface
{
    public const INTEGER_MINIMUM_RANGE = 0;
    public const INTEGER_MAXIMUM_RANGE = 255;
}
