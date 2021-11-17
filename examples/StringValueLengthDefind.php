<?php declare(strict_types=1);

namespace Ivo\Example;

use Ivo\Example\Interface\StringValueLengthDefindInterface;
use Ivo\Trait\StringValueTrait;

final class StringValueLengthDefind implements StringValueLengthDefindInterface
{
    use StringValueTrait;
}
