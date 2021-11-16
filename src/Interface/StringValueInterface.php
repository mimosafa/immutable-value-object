<?php

namespace Ivo\Interface;

use Stringable;

interface StringValueInterface extends ScalarValueInterface, Stringable
{
    /**
     * Define whether to accept multibyte string as raw value
     * - Default is true (multibyte acceptable)
     *
     * @var bool
     */
    # public const MULTIBYTE_STRING_ACCEPTABLE = false;

    /**
     * Define an acceptable string regex pattern, if necessary
     *
     * @var string Regexp
     */
    # public const STRING_REGEXP_PATTERN = '/\w+/';

    /**
     * Define the minimum length of the string, if necessary
     *
     * @var int
     */
    # public const STRING_MINIMUM_LENGTH = 0;

    /**
     * Define the maximum length of the string, if necessary
     *
     * @var int
     */
    # public const STRING_MAXIMUM_LENGTH = 256;

    /**
     * Raw value getter
     *
     * @return mixed
     */
    public function value(): string;
}
