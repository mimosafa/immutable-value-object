<?php

namespace Ivo\Interface;

/**
 * Pseudo BackedEnum interface
 *
 * @see https://www.php.net/manual/en/class.backedenum.php
 */
interface BackedEnumInterface extends UnitEnumInterface
{
    /**
     * Maps a scalar to an enum instance
     *
     * @param int|string $value
     * @return static
     */
    public static function from($value): static;

    /**
     * Maps a scalar to an enum instance or null
     *
     * @param int|string $value
     * @return static|null
     */
    public static function tryFrom($value): ?static;
}
