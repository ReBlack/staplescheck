<?php

use PHPUnit\Framework\TestCase;
use Staplescheck\Validator;

class ValidatorTest extends TestCase
{
    /**
     * @dataProvider providerIsValid
     * @param string $staples
     * @param bool $expected
     * @param bool $isException
     * @return void
     */
    public function testIsValid(string $staples, bool $expected, bool $isException = false): void
    {
        $validator = new Validator($staples);

        if ($isException) {
            $this->expectException(InvalidArgumentException::class);
        }

        $this->assertEquals($expected, $validator->isValid());
    }

    public static function providerIsValid(): array
    {
        return [
            ['()', true],
            ['()()()()', true],
            ['(()()', false],
            ['(()())(((((((', false],
            ['(()())((((((()))))))', true],
            ['(234234)', false, true],
            ['(\n)', true, false],
            ['(\r)', true, false],
            ['(\t)', true, false],
            ['( )', true, false],
            ['(,)', true, false],
            ['(\p)', false, true],
            ['()\n()\r ( ),(\t )', true, false],
        ];
    }
}