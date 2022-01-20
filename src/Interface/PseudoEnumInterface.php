<?php

namespace Ivo\Interface;

interface PseudoEnumInterface extends BackedEnumInterface, ScalarInterface
{
    /**
     * Name of Enum Case
     *
     * @return string
     */
    public function name(): string;

    /**
     * Enum Cases as scalar value
     *
     * @return array<string, int|string>
     */
    public static function toArray(): array;

    /**
     * Get all Enum Cases with name
     *
     * @return array<string, static>
     */
    public static function all(): array;
}
