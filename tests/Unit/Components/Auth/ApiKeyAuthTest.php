<?php

declare(strict_types=1);

namespace Unit\Components\Auth;

use app\components\auth\ApiKeyAuth;
use Yii;
use yii\web\Response;
use yii\web\Request;
use yii\web\UnauthorizedHttpException;

final class ApiKeyAuthTest extends \Codeception\Test\Unit
{
    public function testAuthenticateReturnsTrueWithValidApiKey(): void
    {
        Yii::$app->params['apiKey'] = 'dev-secret-key';

        $request = new Request();
        $request->headers->set('X-API-Key', 'dev-secret-key');

        $response = new Response();

        $auth = new ApiKeyAuth();

        $this->assertTrue(
            $auth->authenticate(null, $request, $response)
        );
    }

    public function testAuthenticateThrowsExceptionWithInvalidApiKey(): void
    {
        Yii::$app->params['apiKey'] = 'dev-secret-key';

        $request = new Request();
        $request->headers->set('X-API-Key', 'wrong-key');

        $response = new Response();

        $auth = new ApiKeyAuth();

        $this->expectException(UnauthorizedHttpException::class);

        $auth->authenticate(null, $request, $response);
    }

    public function testAuthenticateThrowsExceptionWithoutApiKey(): void
    {
        Yii::$app->params['apiKey'] = 'dev-secret-key';

        $request = new Request();

        $response = new Response();

        $auth = new ApiKeyAuth();

        $this->expectException(UnauthorizedHttpException::class);

        $auth->authenticate(null, $request, $response);
    }
}
