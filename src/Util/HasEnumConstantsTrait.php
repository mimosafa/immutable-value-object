<?php declare(strict_types=1);

namespace Ivo\Util;

use LogicException;
use ReflectionClass;

trait HasEnumConstantsTrait
{
    use HasConstantsTrait;

    /**
     * Enum Cases cache for classes
     *
     * @var array
     */
    protected static $casesCache = [];

    /**
     * Get Enum Cases as array
     *
     * @return array<array<string, int|string>>
     */
    public static function toArray(): array
    {
        $class = \get_called_class();
        return self::$casesCache[$class] ?? self::$casesCache[$class] = static::expandConstantsToArray();
    }

    /**
     * Names of constants treated as Enum Case.
     *
     * You SHOULD overwrite this method if necessary.
     * This method has priority over `excludeConstantsFromEnums()` method.
     *
     * @return array<string>
     */
    protected static function extractConstantsToEnums(): array
    {
        return [];
    }

    /**
     * Names of constants not Enum Case.
     *
     * You SHOULD overwrite this method if necessary.
     * `extractConstantsToEnums()` method has priority over this method.
     *
     * @return array<string>
     */
    protected static function excludeConstantsFromEnums(): array
    {
        return [];
    }

    /**
     * Expand constants to array
     *
     * @return array<string, int|string>
     */
    protected static function expandConstantsToArray(): array
    {
        $cases = (new ReflectionClass(\get_called_class()))->getConstants();

        if ($extracted = static::extractConstantsToEnums()) {
            $cases = \array_filter($cases, function (string $name) use ($extracted) {
                return \in_array($name, $extracted, true);
            }, ARRAY_FILTER_USE_KEY);
        }
        else if ($excluded = static::excludeConstantsFromEnums()) {
            $cases = \array_filter($cases, function (string $name) use ($excluded) {
                return ! \in_array($name, $excluded, true);
            }, ARRAY_FILTER_USE_KEY);
        }

        if (\count($cases) !== \count(\array_unique($cases))) {
            throw new LogicException();
        }

        foreach ($cases as $value) {
            if (! \is_int($value) && ! \is_string($value)) {
                throw new LogicException();
            }
        }

        return $cases;
    }
}
