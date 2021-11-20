<?php

namespace Ivo\Example\Interface;

use Ivo\Interface\StringInterface;

interface StringLengthDefindInterface extends StringInterface
{
    public const MINIMUM_LENGTH = 4;
    public const MAXIMUM_LENGTH = 8;
}
