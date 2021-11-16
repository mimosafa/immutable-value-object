<?php

namespace Ivo\Mock\Interface;

use Ivo\Interface\StringValueInterface;

interface StringValueMultibyteNotAcceptableInterface extends StringValueInterface
{
    public const MULTIBYTE_STRING_ACCEPTABLE = false;
}
