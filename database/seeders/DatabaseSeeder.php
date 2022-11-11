<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Participant;
use App\Models\Post;
use Illuminate\Database\Seeder;
use \App\Models\Session;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Create sessions.
        $sessions = Session::factory(5)->create();

        foreach ($sessions as $session) {
            // Create participants for each session.
            $participants = Participant::factory()
                ->for($session)
                ->count(rand(3, 8))
                ->create();

            // Create posts per participant per session.
            foreach ($participants as $participant) {
                Post::factory()
                    ->for($participant)
                    ->for($session)
                    ->count(rand(4, 10))
                    ->create();
            }
        }
    }
}
