<?php

namespace Ivo\Example\Interface;

use Ivo\Interface\StringInterface;

interface StringMultibyteNotAcceptableInterface extends StringInterface
{
    public const MULTIBYTE = false;
}
