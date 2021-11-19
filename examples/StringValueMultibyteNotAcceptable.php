<?php declare(strict_types=1);

namespace Ivo\Example;

use Ivo\Example\Interface\StringMultibyteNotAcceptableInterface;
use Ivo\Trait\StringTrait;

final class StringValueMultibyteNotAcceptable implements StringMultibyteNotAcceptableInterface
{
    use StringTrait;
}
