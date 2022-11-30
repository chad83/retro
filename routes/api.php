<?php

use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->group(function () {

    // Sessions
    Route::prefix('session')->group(function () {
        Route::post('/', [SessionController::class, 'create']);
        Route::post('/state', [SessionController::class, 'setState']);

        Route::get('/{key}', [SessionController::class, 'find']);
        Route::get('/{key}/participants', [SessionController::class, 'getParticipants']);
        Route::get('/{key}/posts', [SessionController::class, 'getPosts']);
        Route::get('/{key}/state', [SessionController::class, 'getState']);
    });

    // Participants
    Route::prefix('participant')->group(function () {
        Route::post('/', [ParticipantController::class, 'create']);

        Route::get('/{key}', [ParticipantController::class, 'find']);
    });

    // Posts
    Route::prefix('post')->group(function () {
        Route::post('/', [PostController::class, 'create']);

        Route::get(
            '/getparticipantposts/{sessionKey}/{participantKey}',
            [PostController::class, 'getParticipantPosts']
        );

//        Route::get('/getpostitcolors', function () {
//            return ['#ff7eb9', '#7afcff', '#feff9c'];
//        });
    });

});
