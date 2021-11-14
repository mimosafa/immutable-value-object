<?php

namespace Ivo\Trait;

trait HasConstantsTrait
{
    protected static function constant(string $name)
    {
        return static::hasConstant($name) ? \constant(static::constantName($name)) : null;
    }

    protected static function hasConstant(string $name): bool
    {
        return \defined(self::constantName($name));
    }

    protected static function constantName(string $name): string
    {
        return static::class . '::' . $name;
    }
}
