<?php declare(strict_types=1);

namespace Ivo\Example;

use Ivo\Example\Interface\IntegerRangeDefinedInterface;
use Ivo\Trait\IntegerTrait;

final class IntegerValueRangeDefined implements IntegerRangeDefinedInterface
{
    use IntegerTrait;
}
