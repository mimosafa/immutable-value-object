<?php declare(strict_types=1);

namespace Ivo\Util;

trait HasConstantsTrait
{
    private static function constant(string $name)
    {
        return self::hasConstant($name) ? \constant(self::constantName($name)) : null;
    }

    private static function hasConstant(string $name): bool
    {
        return \defined(self::constantName($name));
    }

    private static function constantName(string $name): string
    {
        return self::class . '::' . $name;
    }
}
