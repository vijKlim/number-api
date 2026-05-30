<?php

declare(strict_types=1);

namespace app\models;

use yii\base\Model;

class EvenSumRequestForm extends Model
{
    public mixed $numbers = null;

    public function rules(): array
    {
        return [
            [['numbers'], 'required'],
            [['numbers'], 'validateNumbers', 'skipOnEmpty' => false],
        ];
    }

    public function validateNumbers(string $attribute): void
    {
        if (!is_array($this->$attribute)) {
            $this->addError($attribute, 'numbers must be array');
            return;
        }

        foreach ($this->$attribute as $number) {
            if (!is_numeric($number)) {
                $this->addError($attribute, 'numbers must be numeric');
                return;
            }
        }
    }

    public function formName(): string
    {
        return '';
    }
}
