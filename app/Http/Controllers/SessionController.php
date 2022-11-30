<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SessionController extends Controller
{
    public function find(string $key): Session
    {
        return Session::select(['key', 'state'])->where('key', $key)->first();
    }

    public function getParticipants(string $key): Session
    {
        return Session::with(['participants'])
            ->where('sessions.key', $key)
            ->first();
    }

    public function getPosts(string $key): Collection
    {
        return Session::with('posts')
            ->where('sessions.key', $key)
            ->get();
    }

    /**
     * This method should not be exposed and should only be used internally.
     *
     * @param string $key
     * @return Session
     */
    public function getSessionId(string $key): Session
    {
        return Session::select('id')->where('key', $key)->first();
    }

    public function getState(string $key)
    {
        return Session::select('state')->where('key', $key)->first();
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
