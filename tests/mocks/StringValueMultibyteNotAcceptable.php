<?php declare(strict_types=1);

namespace Ivo\Mock;

use Ivo\Mock\Interface\StringValueMultibyteNotAcceptableInterface;
use Ivo\Trait\StringValueTrait;

final class StringValueMultibyteNotAcceptable implements StringValueMultibyteNotAcceptableInterface
{
    use StringValueTrait;
}
