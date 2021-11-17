<?php

namespace Ivo\Example;

use Ivo\Interface\ScalarValueInterface;
use Ivo\Trait\ScalarValueTrait;

final class ScalarValue implements ScalarValueInterface
{
    use ScalarValueTrait;

    public static function validate($value): bool
    {
        return \is_scalar($value);
    }
}
