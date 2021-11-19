<?php declare(strict_types=1);

namespace Ivo\Example;

use Ivo\Interface\StringInterface;
use Ivo\Trait\StringTrait;

final class StringValue implements StringInterface
{
    use StringTrait;
}
