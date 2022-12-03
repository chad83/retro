<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SessionController extends Controller
{
    public function find(string $sessionKey): Session
    {
        return Session::select(['key', 'state'])->where('key', $sessionKey)->first();
    }

    public function getSessionDetails(string $sessionKey): Session
    {
        $session = Session::with(['participants', 'posts'])
            ->where('key', $sessionKey)
            ->first();

        // Calculate the voting data.
        $totalRating = 0;
        $numberOfVoters = 0;
        foreach ($session->participants as $participant) {
            if (is_numeric($participant->session_rating)) {
                $totalRating += $participant->session_rating;
                $numberOfVoters++;
            }
        }

        // Add the voting data to the results.
        $session->numberOfVoters = $numberOfVoters;
        $session->ratingAverage = round($totalRating / $numberOfVoters, 2);

        return $session;
    }

    public function getParticipants(string $key): Session
    {
        return Session::with(['participants'])
            ->where('sessions.key', $key)
            ->first();
    }

    public function getPosts(string $sessionKey): Collection
    {
        return Session::with('posts')
            ->where('sessions.key', $sessionKey)
            ->get();
    }

    /**
     * This method should not be exposed and should only be used internally.
     *
     * @param string $sessionKey
     * @return Session
     */
    public function getSessionId(string $sessionKey): Session
    {
        return Session::select('id')->where('key', $sessionKey)->first();
    }

    public function getState(string $sessionKey)
    {
        return Session::select('state')->where('key', $sessionKey)->first();
    }

    public function create(Request $request)
    {
        $session = Session::create([
            'name' => $request->name
        ]);
        $session->save();

        return $session->fresh();
    }

    public function setState(Request $request)
    {
        $update = Session::where('key', $request->sessionKey)
            ->update(['state' => $request->state]);

        if ($update === 1) {
            return \Response::json([], 200);
        }
    }
}
