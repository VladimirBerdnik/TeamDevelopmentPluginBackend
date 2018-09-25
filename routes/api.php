<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\Api\v1\EditedFilesApiController;
use App\Http\Controllers\Api\v1\PingApiController;
use Dingo\Api\Routing\Router;
use Saritasa\LaravelControllers\Api\ApiResourceRegistrar;

/**
 * Api router instance.
 *
 * @var Router $api
 */
$api = app(Router::class);
$api->version(config('api.version'), ['middleware' => 'bindings'], function(Router $api) {
    $registrar = new ApiResourceRegistrar($api);

    $registrar->get('ping', PingApiController::class, 'ping');

    /**
     * File revisions routes.
     */
    $registrar->post('revisions', EditedFilesApiController::class, 'store');
});
