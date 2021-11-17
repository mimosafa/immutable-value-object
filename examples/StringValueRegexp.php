<?php declare(strict_types=1);

namespace Ivo\Example;

use Ivo\Example\Interface\StringValueRegexpInterface;
use Ivo\Trait\StringValueTrait;

final class StringValueRegexp implements StringValueRegexpInterface
{
    use StringValueTrait;
}
