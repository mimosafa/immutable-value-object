<?php

namespace Ivo\Example;

use Ivo\Interface\ScalarInterface;
use Ivo\Trait\ScalarTrait;

final class ScalarValue implements ScalarInterface
{
    use ScalarTrait;

    public static function validate($value): bool
    {
        return \is_scalar($value);
    }
}
