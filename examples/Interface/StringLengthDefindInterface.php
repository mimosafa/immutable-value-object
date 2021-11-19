<?php

namespace Ivo\Example\Interface;

use Ivo\Interface\StringInterface;

interface StringLengthDefindInterface extends StringInterface
{
    public const STRING_MINIMUM_LENGTH = 4;
    public const STRING_MAXIMUM_LENGTH = 8;
}
