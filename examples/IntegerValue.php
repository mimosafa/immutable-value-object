<?php declare(strict_types=1);

namespace Ivo\Example;

use Ivo\Interface\IntegerInterface;
use Ivo\Trait\IntegerTrait;

final class IntegerValue implements IntegerInterface
{
    use IntegerTrait;
}
