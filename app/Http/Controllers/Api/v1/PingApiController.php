<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\JsonResponse;
use Saritasa\LaravelControllers\Api\BaseApiController;

/**
 * Team Development plugin service ping controller. Allows to ping service and check that service started.
 */
class PingApiController extends BaseApiController
{
    /**
     * Ping request handler. Answers to ping request.
     *
     * @return JsonResponse
     */
    public function ping(): JsonResponse
    {
        return new JsonResponse(['pong']);
    }
}
