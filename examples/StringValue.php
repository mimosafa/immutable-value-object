<?php declare(strict_types=1);

namespace Ivo\Example;

use Ivo\Interface\StringValueInterface;
use Ivo\Trait\StringValueTrait;

final class StringValue implements StringValueInterface
{
    use StringValueTrait;
}
