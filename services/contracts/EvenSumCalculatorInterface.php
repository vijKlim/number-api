<?php
declare(strict_types=1);

namespace app\services\contracts;

use app\dto\EvenSumRequestDto;
use app\dto\EvenSumResponseDto;

interface EvenSumCalculatorInterface
{
    public function calculate(EvenSumRequestDto $requestDto): EvenSumResponseDto;
}
