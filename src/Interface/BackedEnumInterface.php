<?php

namespace Ivo\Interface;

interface BackedEnumInterface extends UnitEnumInterface
{
    public static function from($value): static;
    public static function tryFrom($value): ?static;
}
