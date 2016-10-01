<?php
use Illuminate\Routing\Router;

Route::group([
    'prefix' => 'api',
    'namespace' => 'Schweppesale\Module\Media\Presentation\Http\Controllers\Api'
], function (Router $router) {

    $router->group(['middleware' => 'auth:api'], function (Router $router) {
        $router->resource('videos', 'VideoController');

        $router->get('videos/{video}/clips', [
            'as' => 'videos.clips.index',
            'uses' => 'VideoClipController@indexByVideo'
        ]);
        $router->resource('video-clips', 'VideoClipController');

    });
});