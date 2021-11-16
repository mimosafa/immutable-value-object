<?php

namespace Ivo\Mock\Interface;

use Ivo\Interface\StringValueInterface;

interface StringValueLengthDefindInterface extends StringValueInterface
{
    public const STRING_MINIMUM_LENGTH = 4;
    public const STRING_MAXIMUM_LENGTH = 8;
}
