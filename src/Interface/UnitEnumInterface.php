<?php

namespace Ivo\Interface;

/**
 * Pseudo UnitEnum interface
 *
 * @see https://www.php.net/manual/en/class.unitenum.php
 *
 * @property-read string $name
 */
interface UnitEnumInterface
{
    /**
     * Generates a list of cases on an enum
     *
     * @return array<static>
     */
    public function cases(): array;
}
