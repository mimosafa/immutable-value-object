<?php declare(strict_types=1);

namespace Ivo\Example;

use Ivo\Example\Interface\StringValueMultibyteNotAcceptableInterface;
use Ivo\Trait\StringValueTrait;

final class StringValueMultibyteNotAcceptable implements StringValueMultibyteNotAcceptableInterface
{
    use StringValueTrait;
}
