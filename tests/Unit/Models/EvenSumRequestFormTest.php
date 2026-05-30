<?php

namespace Unit\Models;

use app\models\EvenSumRequestForm;

class EvenSumRequestFormTest extends \Codeception\Test\Unit
{
    public function testValidationPassesWithValidNumbers(): void
    {
        $form = new EvenSumRequestForm();

        $form->setAttributes([
            'numbers' => [1,2,3,4],
        ]);

        $this->assertTrue($form->validate());
    }

    public function testValidationFailsWhenNumbersMissing(): void
    {
        $form = new EvenSumRequestForm();

        $this->assertFalse($form->validate());
        $this->assertArrayHasKey('numbers', $form->getErrors());
    }

    public function testValidationFailsWhenNumbersIsNotArray(): void
    {
        $form = new EvenSumRequestForm();

        $form->setAttributes([
            'numbers' => '123',
        ]);

        $this->assertFalse($form->validate());
    }
}
