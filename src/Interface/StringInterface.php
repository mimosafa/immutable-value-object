<?php

namespace Ivo\Interface;

interface StringInterface extends ScalarInterface
{
    /**
     * Define whether to accept multibyte string as raw value
     * - Default is true (multibyte acceptable)
     *
     * @var bool
     */
    # public const MULTIBYTE = false;

    /**
     * Define an acceptable string regex pattern, if necessary
     *
     * @var string Regexp
     */
    # public const REGEXP_PATTERN = '/\w+/';

    /**
     * Define the minimum length of the string, if necessary
     *
     * @var int
     */
    # public const MINIMUM_LENGTH = 0;

    /**
     * Define the maximum length of the string, if necessary
     *
     * @var int
     */
    # public const MAXIMUM_LENGTH = 256;

    /**
     * Raw value getter
     *
     * @return string
     */
    public function value(): string;
}
