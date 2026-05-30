<?php

declare(strict_types=1);

namespace app\controllers;

use app\components\auth\ApiKeyAuth;
use app\dto\EvenSumRequestDto;
use app\models\EvenSumRequestForm;
use app\services\contracts\EvenSumCalculatorInterface;
use Yii;
use yii\rest\Controller;
use yii\web\Response;

class EvenSumController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly EvenSumCalculatorInterface $calculator,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => ApiKeyAuth::class,
        ];

        return $behaviors;
    }

    public function actionIndex(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $form = new EvenSumRequestForm();
        $form->load(Yii::$app->request->bodyParams, '');

        if (!$form->validate()) {
            Yii::$app->response->statusCode = 422;

            return [
                'errors' => $form->getFirstErrors(),
            ];
        }

        $requestDto = new EvenSumRequestDto($form->numbers);
        $responseDto = $this->calculator->calculate($requestDto);

        return $responseDto->toArray();
    }
}
