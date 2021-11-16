<?php declare(strict_types=1);

namespace Ivo\Mock;

use Ivo\Mock\Interface\StringValueRegexpInterface;
use Ivo\Trait\StringValueTrait;

final class StringValueRegexp implements StringValueRegexpInterface
{
    use StringValueTrait;
}
