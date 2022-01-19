<?php declare(strict_types=1);

namespace Ivo\Trait;

use LogicException;
use ReflectionClass;
use ValueError;

/**
 * @property string $name
 */
trait PseudoEnumTrait
{
    use ScalarTrait;

    protected static $enums = [];

    public function key(): string
    {
        return static::search($this->value());
    }

    public function __get($name)
    {
        if ($name === 'name') {
            return $this->key();
        }
        \trigger_error("Undefined property: {$name}", E_USER_WARNING);
    }

    public static function from($value): static
    {
        if ($enum = static::tryFrom($value)) {
            return $enum;
        }
        throw new ValueError();
    }

    public static function tryFrom($value): ?static
    {
        return static::validate($value) ? static::instance($value) : null;
    }

    public static function validate($value): bool
    {
        return \is_scalar($value) && \in_array($value, static::toArray(), true);
    }

    public static function cases(): array
    {
        $class = \get_called_class();
        return \array_map([$class, 'instance'], \array_values(static::toArray()));
    }

    public static function toArray(): array
    {
        $class = \get_called_class();
        return static::$enums[$class] ?? static::$enums[$class] = self::expandConstantsToEnums();
    }

    public static function search($value): string|false
    {
        return static::validate($value) ? \array_search($value, static::toArray(), true) : false;
    }

    protected static function extractConstantsToEnums(): array
    {
        return [];
    }

    protected static function excludeConstantsFromEnums(): array
    {
        return [];
    }

    protected static function expandConstantsToEnums(): array
    {
        $enums = (new ReflectionClass(\get_called_class()))->getConstants();

        if ($extracted = static::extractConstantsToEnums()) {
            $enums = \array_filter($enums, function (string $key) use ($extracted) {
                return \in_array($key, $extracted, true);
            }, ARRAY_FILTER_USE_KEY);
        }
        else if ($excluded = static::excludeConstantsFromEnums()) {
            $enums = \array_filter($enums, function (string $key) use ($excluded) {
                return ! \in_array($key, $excluded, true);
            }, ARRAY_FILTER_USE_KEY);
        }

        if (\count($enums) !== \count(\array_unique($enums))) {
            throw new LogicException();
        }

        foreach ($enums as $value) {
            if (! \is_int($value) && ! \is_string($value)) {
                throw new LogicException();
            }
        }

        return $enums;
    }
}
