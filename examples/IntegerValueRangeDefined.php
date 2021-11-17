<?php declare(strict_types=1);

namespace Ivo\Example;

use Ivo\Example\Interface\IntegerValueRangeDefinedInterface;
use Ivo\Trait\IntegerValueTrait;

final class IntegerValueRangeDefined implements IntegerValueRangeDefinedInterface
{
    use IntegerValueTrait;
}
