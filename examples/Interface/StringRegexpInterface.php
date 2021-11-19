<?php

namespace Ivo\Example\Interface;

use Ivo\Interface\StringInterface;

interface StringRegexpInterface extends StringInterface
{
    public const STRING_REGEXP_PATTERN = '/^a[b-y]+z$/';
}
