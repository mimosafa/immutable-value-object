<?php

namespace Ivo\Mock\Interface;

use Ivo\Interface\StringValueInterface;

interface StringValueRegexpInterface extends StringValueInterface
{
    public const STRING_REGEXP_PATTERN = '/^a[b-y]+z$/';
}