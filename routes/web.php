<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('session')->group(function () {
    Route::get('/create', function () {
        return view('sessions.create', ['showCreateJs' => 1, 'showParticipantJs' => 1]);
    });

    Route::get('/{sessionKey}/{participantKey}', function ($sessionKey, $participantKey) {
        return view('sessions.participantsession', [
            'sessionKey' => $sessionKey,
            'participantKey' => $participantKey
        ]);
    });
});

Route::prefix('participant')->group(function () {
    Route::get('/{sessionKey}/create', function ($sessionKey) {
        return view('participants.createparticipant', ['sessionKey' => $sessionKey, 'showParticipantJs' => 1]);
    });
});
