<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function find(string $key)
    {
        return Session::select(['key', 'state'])->where('key', $key)->first();
    }

    public function getParticipants(string $key): Collection
    {
        return Session::with(['participants'])
            ->where('sessions.key', $key)
            ->get();
    }

    public function getPosts(string $key): Collection
    {
        return Session::with('posts')
            ->where('sessions.key', $key)
            ->get();
    }

    public function create(Request $request)
    {
        $session = Session::create([
            'name' => $request->name
        ]);
        $session->save();

        return $session->fresh();
    }
}
