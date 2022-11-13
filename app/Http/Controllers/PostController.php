<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    private ParticipantController $participantController;

    public function __construct(ParticipantController $participantController, SessionController $sessionController)
    {
        $this->participantController = $participantController;
    }

    public function create(Request $request)
    {
        // Get the participant.
        $participant = $this->participantController->find($request->participantKey);

        $post = Post::create([
            'participant_id' => $participant->id,
            'session_id' => $participant->session_id,
            'category' => $request->category,
            'text' => $request->text
        ]);
        $post->save();

        return $post->fresh();
    }
}
