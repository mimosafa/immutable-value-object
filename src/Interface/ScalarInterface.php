<?php

namespace Ivo\Interface;

interface ScalarInterface
{
    /**
     * Get a scalar value
     *
     * @return mixed
     */
    public function value();

    /**
     * Check for equivalence
     *
     * @param mixed $value
     * @return bool
     */
    public function equals($value): bool;

    /**
     * Validate a given value
     *
     * @param mixed $value
     * @return bool
     */
    public static function validate($value): bool;

    /**
     * Get instance with raw value
     *
     * @param mixed $value
     * @return static
     */
    public static function instance($value): static;
}
