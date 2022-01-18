<?php declare(strict_types=1);

namespace Ivo\Test;

use Faker\Factory;
use Ivo\Trait\ScalarTrait;
use PHPUnit\Framework\TestCase;

final class ScalarTest extends TestCase
{
    public function test_value()
    {
        $faker = Factory::create();
        foreach ([$faker->boolean(), $faker->text(20), $faker->randomNumber(),] as $value) {
            $instance = MockScalar::instance($value);
            $this->assertEquals($value, $instance->value());
        }
    }

    public function test_equals()
    {
        $faker = Factory::create();

        $value = $faker->randomNumber();
        $differentValue = $value + $faker->randomDigitNotZero();

        $one = MockScalar::instance($value);
        $sameOne = MockScalar::instance($value); // Same class & value
        $different = MockScalar::instance($differentValue); // Same class but different value
        $otherClass = MockScalarAnother::instance($value); // Same value but other class
        $inherited = MockScalarInherited::instance($value); // Same value but other(inherited) class

        $this->assertTrue($one->equals($sameOne));

        $this->assertFalse($one->equals($value));
        $this->assertFalse($one->equals($different));
        $this->assertFalse($one->equals($otherClass));
        $this->assertFalse($one->equals($inherited));
    }
}

class MockScalar
{
    use ScalarTrait;

    public static function validate($value): bool
    {
        return \is_scalar($value);
    }
}

class MockScalarAnother
{
    use ScalarTrait;

    public static function validate($value): bool
    {
        return \is_scalar($value);
    }
}

class MockScalarInherited extends MockScalar
{
}
