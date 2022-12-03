<?php

use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\SessionController;
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
    return view('sessions.create', ['showCreateJs' => 1, 'showParticipantJs' => 1]);
});

Route::prefix('session')->group(function () {
    // Session-creation page.
    Route::get('/create', function () {
        return view('sessions.create', ['page' => 'createSession', 'showCreateJs' => 1, 'showParticipantJs' => 1]);
    });

    // Results page.
    Route::get('/{sessionKey}/results', function ($sessionKey) {
        return view('sessions.results', [
            'page' => 'sessionResults',
            'sessionKey' => $sessionKey,
            'session' => (new SessionController)->getSessionDetails($sessionKey)
        ]);
    });

    // Participant's filling page.
    Route::get('/{sessionKey}/{participantKey}', function ($sessionKey, $participantKey) {
        return view('sessions.participantsession', [
            'page' => 'filling',
            'sessionKey' => $sessionKey,
            'participantKey' => $participantKey,
            'participant' => (new ParticipantController)->find($participantKey)
        ]);
    });
});

Route::prefix('participant')->group(function () {
    Route::get('/{sessionKey}/create', function ($sessionKey) {
        return view('participants.createparticipant',
            [
                'sessionKey' => $sessionKey,
                'showParticipantJs' => 1,
            ]);
    });
});
