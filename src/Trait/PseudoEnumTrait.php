<?php declare(strict_types=1);

namespace Ivo\Trait;

use Ivo\Util\HasEnumConstantsTrait;
use ValueError;

/**
 * Pseudo Enum trait
 *
 * @property-read string $name
 * @property-read int|string $value
 */
trait PseudoEnumTrait
{
    use ScalarTrait, HasEnumConstantsTrait;

    /**
     * Get name of enum
     *
     * @return string
     */
    public function name(): string
    {
        return static::search($this->value());
    }

    /**
     * Read-only properties getter
     *
     * @param string $name
     * @return string|int
     */
    public function __get($name)
    {
        if ($name === 'name') {
            /**
             * @see https://www.php.net/manual/en/language.enumerations.basics.php
             */
            return $this->name();
        }
        if ($name === 'value') {
            /**
             * @see https://www.php.net/manual/en/language.enumerations.backed.php
             */
            return $this->value();
        }
        \trigger_error("Undefined property: {$name}", E_USER_WARNING);
    }

    /**
     * Maps a scalar to an enum instance
     *
     * @see https://www.php.net/manual/en/language.enumerations.backed.php
     *
     * @param mixed $value
     * @return static
     * @throws ValueError
     */
    public static function from($value): static
    {
        if ($case = static::tryFrom($value)) {
            return $case;
        }
        throw new ValueError();
    }

    /**
     * Maps a scalar to an enum instance or null
     *
     * @see https://www.php.net/manual/en/language.enumerations.backed.php
     *
     * @param mixed $value
     * @return static|null
     */
    public static function tryFrom($value): ?static
    {
        return static::validate($value) ? static::instance($value) : null;
    }

    public static function validate($value): bool
    {
        return \is_scalar($value) && \in_array($value, static::toArray(), true);
    }

    /**
     * Generates a list of cases on an enum
     *
     * @return array<static>
     */
    public static function cases(): array
    {
        return \array_values(static::all());
    }

    /**
     * Get all Enum Cases with name
     *
     * @return array<string, static>
     */
    public static function all(): array
    {
        $class = \get_called_class();
        return \array_map([$class, 'instance'], static::toArray());
    }

    public static function search($value): string|false
    {
        return static::validate($value) ? \array_search($value, static::toArray(), true) : false;
    }
}
