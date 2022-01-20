<?php declare(strict_types=1);

namespace Ivo\Test\Trait;

use Ivo\Trait\PseudoEnumTrait;
use PHPUnit\Framework\TestCase;

final class PseudoEnumTraitTest extends TestCase
{
    public function test_name_method_and_property()
    {
        $kochi = MockEnumShikoku::from('高知県');
        $this->assertEquals('Kochi', $kochi->name());

        $ehime = MockEnumShikoku::from('愛媛県');
        $this->assertEquals('Ehime', $ehime->name);
    }

    public function test_value_property()
    {
        $kagawa = MockEnumShikoku::from('香川県');
        $this->assertEquals('香川県', $kagawa->value);
    }
}

final class MockEnumShikoku
{
    use PseudoEnumTrait;
    private const Tokushima = '徳島県';
    private const Kagawa = '香川県';
    private const Ehime = '愛媛県';
    private const Kochi = '高知県';
}
