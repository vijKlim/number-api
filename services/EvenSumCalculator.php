<?php
declare(strict_types=1);

namespace app\services;

use app\dto\EvenSumRequestDto;
use app\dto\EvenSumResponseDto;
use app\services\contracts\EvenSumCalculatorInterface;

class EvenSumCalculator implements EvenSumCalculatorInterface
{

    public function calculate(EvenSumRequestDto $requestDto): EvenSumResponseDto
    {
        return new EvenSumResponseDto(
            array_sum(
                array_filter(
                    $requestDto->numbers,
                    static fn (int $number): bool => $number % 2 === 0
                )
            )
        );
    }
}
