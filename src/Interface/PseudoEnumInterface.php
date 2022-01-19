<?php

namespace Ivo\Interface;

interface PseudoEnumInterface extends BackedEnumInterface, ScalarInterface
{
    public function key(): string;
    public static function toArray(): array;
}
