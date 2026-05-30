<?php

declare(strict_types=1);

namespace app\dto;

final readonly class EvenSumRequestDto
{
    /**
     * @param int[] $numbers
     */
    public function __construct(public array $numbers)
    {
    }
}
