<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function find(string $key)
    {
        return Participant::where(['key' => $key])->first();
    }

    public function create(Request $request, SessionController $sessionController)
    {
        // Get the session ID.
        $currentSession = $sessionController->getSessionId($request->sessionKey);

        $participant = Participant::create([
            'session_id' => $currentSession->id,
            'name' => $request->name,
            'color' => $request->color,
        ]);

        $participant->save();

        return $participant->fresh();
    }

    public function rateSession(Request $request)
    {
        $update = Participant::where('key', $request->participant_key)
            ->update(['session_rating' => $request->session_rating]);

        if ($update === 1) {
            return \Response::json([], 200);
        }
    }
}
