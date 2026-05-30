<?php

namespace Unit\Services;

use app\dto\EvenSumRequestDto;
use app\services\EvenSumCalculator;

class EvenSumCalculatorTest extends \Codeception\Test\Unit
{
    public function testCalculateReturnsSumOfEvenNumbers(): void
    {
        $calculator = new EvenSumCalculator();

        $result = $calculator->calculate(
            new EvenSumRequestDto([1, 2, 3, 4, 5, 6])
        );

        $this->assertSame(12, $result->sum);
    }

    public function testCalculateReturnsZeroWhenNoEvenNumbers(): void
    {
        $calculator = new EvenSumCalculator();

        $result = $calculator->calculate(
            new EvenSumRequestDto([1, 3, 5])
        );

        $this->assertSame(0, $result->sum);
    }

    public function testCalculateWorksWithNegativeNumbers(): void
    {
        $calculator = new EvenSumCalculator();

        $result = $calculator->calculate(
            new EvenSumRequestDto([-2, 4, 5])
        );

        $this->assertSame(2, $result->sum);
    }

    public function testCalculateWorksWithEmptyArray(): void
    {
        $calculator = new EvenSumCalculator();

        $result = $calculator->calculate(
            new EvenSumRequestDto([])
        );

        $this->assertSame(0, $result->sum);
    }
}
