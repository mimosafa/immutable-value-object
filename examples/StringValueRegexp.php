<?php declare(strict_types=1);

namespace Ivo\Example;

use Ivo\Example\Interface\StringRegexpInterface;
use Ivo\Trait\StringTrait;

final class StringValueRegexp implements StringRegexpInterface
{
    use StringTrait;
}
