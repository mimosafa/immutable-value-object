<?php declare(strict_types=1);

namespace Ivo\Example;

use Ivo\Example\Interface\StringLengthDefindInterface;
use Ivo\Trait\StringTrait;

final class StringValueLengthDefind implements StringLengthDefindInterface
{
    use StringTrait;
}
