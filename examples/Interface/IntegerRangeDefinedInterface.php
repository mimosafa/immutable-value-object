<?php

namespace Ivo\Example\Interface;

use Ivo\Interface\IntegerInterface;

interface IntegerRangeDefinedInterface extends IntegerInterface
{
    public const MINIMUM = 0;
    public const MAXIMUM = 255;
}
