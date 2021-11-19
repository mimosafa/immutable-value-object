<?php

namespace Ivo\Interface;

interface ScalarInterface
{
    /**
     * Raw value getter
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
     * Raw value validater
     *
     * @abstract
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
