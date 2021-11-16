<?php declare(strict_types=1);

namespace Ivo\Mock;

use Ivo\Mock\Interface\IntegerValueRangeDefinedInterface;
use Ivo\Trait\IntegerValueTrait;

final class IntegerValueRangeDefined implements IntegerValueRangeDefinedInterface
{
    use IntegerValueTrait;
}
