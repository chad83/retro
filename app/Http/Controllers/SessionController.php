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
}
