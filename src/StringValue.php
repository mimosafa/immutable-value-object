<?php declare(strict_types=1);

namespace Ivo;

use Ivo\Interface\StringValueInterface;
use Ivo\Trait\StringValueTrait;

abstract class StringValue extends ScalarValue
{
    use StringValueTrait;

    // public const STRING_MINIMUM_LENGTH = 0;
    // public const STRING_MAXIMUM_LENGTH = null;
    // public const STRING_REGEXP_PATTERN = null;
    // public const STRING_MULTIBYTE = true;
}
