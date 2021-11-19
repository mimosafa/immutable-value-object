<?php declare(strict_types=1);

namespace Ivo\Test;

use Ivo\Example\StringValue;
use Ivo\Example\StringValueLengthDefind;
use Ivo\Example\StringValueMultibyteNotAcceptable;
use Ivo\Example\StringValueRegexp;
use PHPUnit\Framework\TestCase;
use ValueError;

final class StringTest extends TestCase
{
    public function test_to_string()
    {
        $str = StringValue::instance('test');
        $this->assertEquals('test', $str->__toString());
    }

    public function test_value_error()
    {
        $int = 100;
        $this->assertFalse(StringValue::validate($int));
        $this->expectException(ValueError::class);
        StringValue::instance($int);
    }

    public function test_multibyte_not_acceptable()
    {
        $maybeTrues = ['abcdefg', '12345', '_\\/.~*&', '',];
        foreach ($maybeTrues as $maybeTrue) {
            $this->assertTrue(StringValueMultibyteNotAcceptable::validate($maybeTrue));
        }
        $maybeFalses = ['あいうえお', '１２３４５', '＿￥／．〜＊＆', '　'];
        foreach ($maybeFalses as $maybeFalse) {
            $this->assertFalse(StringValueMultibyteNotAcceptable::validate($maybeFalse));
        }
    }

    public function test_regexp()
    {
        $maybeTrues = ['abcdefghijklmnopqrstuvwxyz', 'abz',];
        foreach ($maybeTrues as $maybeTrue) {
            $this->assertTrue(StringValueRegexp::validate($maybeTrue));
        }

        $maybeFalses = ['abc', 'ａｂｃｄｚ', 'a2349z', 'xyz', 'a b z'];
        foreach ($maybeFalses as $maybeFalse) {
            $this->assertFalse(StringValueRegexp::validate($maybeFalse));
        }
    }

    public function test_length_defined()
    {
        $maybeTrues = ['abcd', 'abcdff', 'abcdefgh', 'あいうえ', 'いろはにほへとち', '_ _ _',];
        foreach ($maybeTrues as $maybeTrue) {
            $this->assertTrue(StringValueLengthDefind::validate($maybeTrue));
        }

        $maybeFalses = ['abc', '', 'pqrstuvxw', 'あいう',];
        foreach ($maybeFalses as $maybeFalse) {
            $this->assertFalse(StringValueLengthDefind::validate($maybeFalse));
        }
    }
}
