<?php declare(strict_types=1);

namespace Ivo\Example;

use Ivo\Interface\IntegerValueInterface;
use Ivo\Trait\IntegerValueTrait;

final class IntegerValue implements IntegerValueInterface
{
    use IntegerValueTrait;
}
