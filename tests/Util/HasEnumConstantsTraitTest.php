<?php declare(strict_types=1);

namespace Ivo\Test\Util;

use Ivo\Util\HasEnumConstantsTrait;
use PHPUnit\Framework\TestCase;

final class HasEnumConstantsTraitTest extends TestCase
{
    public function test_to_array()
    {
        $expected = [
            'Hearts' => 'H',
            'Diamonds' => 'D',
            'Clubs' => 'C',
            'Spades' => 'S',
        ];
        $this->assertEquals($expected, MockSuit::toArray());
    }

    public function test_exclude_constants_from_enums()
    {
        $expected = [
            'ASC' => 'asc',
            'DESC' => 'desc',
        ];
        $this->assertEquals($expected, MockSortOrder::toArray());
    }

    public function test_extract_constants_to_enums()
    {
        $expected = [
            'on' => 1,
            'off' => 0,
        ];
        $this->assertEquals($expected, MockSwitch::toArray());
    }
}

final class MockSuit
{
    use HasEnumConstantsTrait;

    const Hearts = 'H';
    const Diamonds = 'D';
    const Clubs = 'C';
    const Spades = 'S';
}

final class MockSortOrder
{
    use HasEnumConstantsTrait;

    const ASC = 'asc';
    const DESC = 'desc';

    const MY_CONST = 'This is not Enum Case.';

    protected static function excludeConstantsFromEnums(): array
    {
        return ['MY_CONST'];
    }
}

final class MockSwitch
{
    use HasEnumConstantsTrait;

    const on = 1;
    const off = 0;

    const MY_CONST = 'This is not Enum Case.';

    protected static function extractConstantsToEnums(): array
    {
        return ['on', 'off',];
    }

    protected static function excludeConstantsFromEnums(): array
    {
        return ['off']; // This will be ignored.
    }
}
