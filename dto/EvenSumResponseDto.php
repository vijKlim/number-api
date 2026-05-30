<?php

declare(strict_types=1);

namespace app\dto;

final readonly class EvenSumResponseDto
{
    public function __construct(public int $sum)
    {
    }

    public function toArray(): array
    {
        return [
            'sum' => $this->sum,
        ];
    }
}
