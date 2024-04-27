<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ActorMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actorMovies = [
            'Christian Bale' => ['The Dark Knight', 'The Dark Knight', 'Inception'],
            'Heath Ledger' => ['The Dark Knight'],
            'Ryan Reynolds' => ['Deadpool'],
            'Robert Downey Jr.' => ['Avengers: Endgame'],
            'Al Pacino' => ['The Godfather'],
            'Marlon Brando' => ['The Godfather'],
            'Leonardo DiCaprio' => ['Inception', 'Once Upon a Time in Hollywood'],
            'Morgan Freeman' => ['The Shawshank Redemption'],
            'Brad Pitt' => ['Once Upon a Time in Hollywood'],
            'Tom Hanks' => ['The Shawshank Redemption'],
            'Quentin Tarantino' => ['Once Upon a Time in Hollywood'],
            'Margot Robbie' => ['Once Upon a Time in Hollywood'],
            'Tom Cruise' => ['Jurassic Park'],
        ];

        foreach ($actorMovies as $actorName => $movies) {
            $actor = Actor::where('name', $actorName)->first();

            foreach ($movies as $movieTitle) {
                $movie = Movie::where('title', $movieTitle)->first();

                // Attach the actor to the movie
                if ($actor && $movie) {
                    DB::table('actor_movie')->insert([
                        'actor_id' => $actor->id,
                        'movie_id' => $movie->id,
                    ]);
                }
            }
        }
    }
}
