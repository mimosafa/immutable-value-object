<?php declare(strict_types=1);

namespace Ivo\Util;

trait HasConstantsTrait
{
    protected static function constant(string $name)
    {
        return static::hasConstant($name) ? \constant(static::constantName($name)) : null;
    }

    protected static function hasConstant(string $name): bool
    {
        return \defined(static::constantName($name));
    }

    protected static function constantName(string $name): string
    {
        return static::class . '::' . $name;
    }
}
