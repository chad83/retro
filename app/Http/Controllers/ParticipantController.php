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
}
