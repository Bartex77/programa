<?php

namespace App\Tests\Service;

use App\Service\NumbersPlay;
use PHPUnit\Framework\TestCase;

class NumbersPlayTest extends TestCase
{
    /**
     * @return array
     */
    public function provideNumbers()
    {
        return [
            ['numbers' => [1, 2, 3, 4], 'result' => NumbersPlay::EVEN_BIGGER],
            ['numbers' => [45, 2, 76, 87, 99], 'result' => NumbersPlay::EQUAL],
            ['numbers' => [3, 17, 55, 2], 'result' => NumbersPlay::EVEN_LESS]
        ];
    }

    /**
     * @dataProvider provideNumbers
     *
     * @param array $numbers
     * @param int   $result
     *
     * @throws \Exception
     */
    public function testResult(array $numbers, int $result)
    {
        $numbersPlay = new NumbersPlay(0, 0);
        foreach ($numbers as $number) {
            $numbersPlay->acceptNumber($number);
        }

        self::assertEquals($result, $numbersPlay->result());
    }

    /**
     * @expectedException \Exception
     */
    public function testResultConstructorException()
    {
        $numbersPlay = new NumbersPlay(-2, 0);
    }

    /**
     * @expectedException \Exception
     */
    public function testResultAcceptNumberException()
    {
        $numbersPlay = new NumbersPlay(0, 0);
        $numbersPlay->acceptNumber(-5);
    }
}
