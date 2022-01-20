<?php declare(strict_types=1);

namespace Ivo\Test\Trait;

use Faker\Factory;
use Ivo\Trait\StringTrait;
use PHPUnit\Framework\TestCase;

final class StringTraitTest extends TestCase
{
    /**
     * Class `MockString` defined in this file
     */
    public function test_validate()
    {
        $faker = Factory::create();

        $string = $faker->word();
        $this->assertTrue(MockString::validate($string));

        $integer = $faker->randomNumber();
        $this->assertFalse(MockString::validate($integer));

        $bool = $faker->boolean();
        $this->assertFalse(MockString::validate($bool));

        $null = null;
        $this->assertFalse(MockString::validate($null));
    }

    public function test_single_byte_string()
    {
        $maybeTrues = ['abcdefg', '12345', '_\\/.~*&', '',];
        foreach ($maybeTrues as $maybeTrue) {
            $this->assertTrue(MockStringSingleByte::validate($maybeTrue));
        }
        $maybeFalses = ['あいうえお', '１２３４５', '＿￥／．〜＊＆', '　'];
        foreach ($maybeFalses as $maybeFalse) {
            $this->assertFalse(MockStringSingleByte::validate($maybeFalse));
        }
    }

    public function test_regexp()
    {
        $maybeTrues = ['abcdefghijklmnopqrstuvwxyz', 'abz',];
        foreach ($maybeTrues as $maybeTrue) {
            $this->assertTrue(MockStringHasRegexp::validate($maybeTrue));
        }

        $maybeFalses = ['abc', 'ａｂｃｄｚ', 'a2349z', 'xyz', 'a b z'];
        foreach ($maybeFalses as $maybeFalse) {
            $this->assertFalse(MockStringHasRegexp::validate($maybeFalse));
        }
    }

    public function test_length()
    {
        $maybeTrues = ['abcd', 'abcdff', 'abcdefgh', 'あいうえ', 'いろはにほへとち', '_ _ _',];
        foreach ($maybeTrues as $maybeTrue) {
            $this->assertTrue(MockStringHasLength::validate($maybeTrue));
        }

        $maybeFalses = ['abc', '', 'pqrstuvxw', 'あいう',];
        foreach ($maybeFalses as $maybeFalse) {
            $this->assertFalse(MockStringHasLength::validate($maybeFalse));
        }
    }
}


/**
 * Mock class for `test_validate()`
 */
final class MockString
{
    use StringTrait;
}

/**
 * Mock class for `test_single_byte_string()`
 */
final class MockStringSingleByte
{
    use StringTrait;
    const MULTIBYTE = false;
}

/**
 * Mock class for `test_regexp()`
 */
final class MockStringHasRegexp
{
    use StringTrait;
    const REGEXP = '/^a[b-y]+z$/';
}

/**
 * Mock class for `test_length()`
 */
final class MockStringHasLength
{
    use StringTrait;
    const MINIMUM_LENGTH = 4;
    const MAXIMUM_LENGTH = 8;
}
