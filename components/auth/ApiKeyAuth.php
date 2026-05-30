<?php

declare(strict_types=1);

namespace app\components\auth;

use Yii;
use yii\filters\auth\AuthMethod;
use yii\web\UnauthorizedHttpException;

final class ApiKeyAuth extends AuthMethod
{
    public function authenticate($user, $request, $response)
    {
        $apiKey = $request->headers->get('X-API-Key');

        if ($apiKey === Yii::$app->params['apiKey']) {
            return true;
        }

        $this->handleFailure($response);
    }

    public function handleFailure($response)
    {
        throw new UnauthorizedHttpException(
            'Invalid API key.'
        );
    }
}
