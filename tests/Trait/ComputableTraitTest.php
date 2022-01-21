<?php declare(strict_types=1);

namespace Ivo\Test\Trait;

use Ivo\Trait\ComputableTrait;
use LogicException;
use PHPUnit\Framework\TestCase;

final class ComputableTraitTest extends TestCase
{
    public function test_validate()
    {
        $maybeOks = [0, 1.1, -9, -35.023, 0x1A, 0b1101, PHP_FLOAT_MIN, PHP_INT_MAX, M_PI,];

        foreach ($maybeOks as $maybeOk) {
            $this->assertTrue(MockComputable::validate($maybeOk));
        }

        $maybeNgs = [true, null, '2001', NAN, INF,];

        foreach ($maybeNgs as $maybeNg) {
            $this->assertFalse(MockComputable::validate($maybeNg));
        }
    }

    public function test_defined_value_range()
    {
        $maybeOks1 = [0, 0.003, M_PI, 4, 5, 5.199,];

        foreach ($maybeOks1 as $maybeOk1) {
            $this->assertTrue(MockComputableHasRange_One::validate($maybeOk1));
        }

        $maybeNgs1 = [-2, -0.00000001, 5.2, 9,];

        foreach ($maybeNgs1 as $maybeNg1) {
            $this->assertFalse(MockComputableHasRange_One::validate($maybeNg1));
        }

        $maybeOks2 = [-254.9, 255];

        foreach ($maybeOks2 as $maybeOk2) {
            $this->assertTrue(MockComputableHasRange_Two::validate($maybeOk2));
        }

        $maybeNgs2 = [-255, 255.000000000001];

        foreach ($maybeNgs2 as $maybeNg2) {
            $this->assertFalse(MockComputableHasRange_Two::validate($maybeNg2));
        }
    }

    public function test_logic_exception_one()
    {
        $this->expectException(LogicException::class);
        MockComputableUnlogical_One::validate(25);
    }

    public function test_logic_exception_two()
    {
        $this->expectException(LogicException::class);
        MockComputableUnlogical_Two::validate(25);
    }

    public function test_logic_exception_three()
    {
        $this->assertTrue(MockComputableUnlogical_Three_1::validate(255));
        $this->assertFalse(MockComputableUnlogical_Three_1::validate(254.8));

        $this->expectException(LogicException::class);
        MockComputableUnlogical_Three_2::validate(255);
    }
}

final class MockComputable
{
    use ComputableTrait;
}

final class MockComputableHasRange_One
{
    use ComputableTrait;
    const GREATER_THAN_OR_EQUAL_TO = 0;
    const LESS_THAN = 5.2;
}

final class MockComputableHasRange_Two
{
    use ComputableTrait;
    const GREATER_THAN = -255;
    const LESS_THAN_OR_EQUAL_TO = 255;
}

final class MockComputableUnlogical_One
{
    use ComputableTrait;
    const GREATER_THAN_OR_EQUAL_TO = 24;
    const GREATER_THAN = 24;
}

final class MockComputableUnlogical_Two
{
    use ComputableTrait;
    const LESS_THAN = 255;
    const LESS_THAN_OR_EQUAL_TO = 80;
}

final class MockComputableUnlogical_Three_1
{
    use ComputableTrait;
    const GREATER_THAN_OR_EQUAL_TO = 255;
    const LESS_THAN_OR_EQUAL_TO = 255;
}

final class MockComputableUnlogical_Three_2
{
    use ComputableTrait;
    const GREATER_THAN_OR_EQUAL_TO = 255;
    const LESS_THAN = 255;
}
