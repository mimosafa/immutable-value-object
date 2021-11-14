<?php

namespace Ivo\Interface;

interface ScalarValueInterface extends ValueInterface
{
    public function equals($value): bool;
    public static function validate($value): bool;
    public static function instance($value): static;
}
