<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Upcoming movies
        $movies = [
            [
                'title' => 'The Dark Knight',
                'description' => "In this thrilling action-packed film, Batman faces his greatest challenge yet as he battles against the Joker and attempts to save Gotham City from chaos and destruction. With stunning visuals and intense performances, The Dark Knight is a must-watch for any superhero fan.",
                'poster_img' => 'images/movies/dark_knight.jpg',
                'duration' => 152,
                'release_date' => Carbon::createFromDate(2008, 7, 23),
                'status' => 'upcoming'
            ],
            [
                'title' => 'Deadpool',
                'description' => "Get ready for a wild ride with Deadpool, the Merc with a Mouth! In this hilarious and action-packed film, Deadpool takes on bad guys, breaks the fourth wall, and makes audiences laugh until they cry. With outrageous stunts and witty one-liners, Deadpool is unlike any other superhero movie you've seen before.",
                'poster_img' => 'images/movies/deadpool.jpg',
                'duration' => 108,
                'release_date' => Carbon::createFromDate(2024, 7, 26),
                'status' => 'upcoming',
            ],
            [
                'title' => 'Avengers: Endgame',
                'description' => "The epic conclusion to the Avengers saga is finally here! In this thrilling film, the Avengers assemble one last time to face off against Thanos and restore the universe to balance. With jaw-dropping action sequences and emotional moments, Avengers: Endgame is a cinematic event you won't want to miss.",
                'poster_img' => 'images/movies/avengers.jpg',
                'duration' => 181,
                'release_date' => Carbon::createFromDate(2019, 4, 26),
                'status' => 'upcoming',
            ],
            [
                'title' => 'The Godfather',
                'description' => "Experience the timeless classic that defined the gangster genre. In The Godfather, follow the Corleone family as they navigate the world of organized crime and struggle to maintain their power and honor. With unforgettable performances and a gripping story, The Godfather is a masterpiece of cinema.",
                'poster_img' => 'images/movies/godfather.jpg',
                'duration' => 175,
                'release_date' => Carbon::createFromDate(1972, 4, 24),
                'status' => 'upcoming',
            ],
            [
                'title' => 'Inception',
                'description' => "Prepare to have your mind blown with Inception, a mind-bending thriller from visionary director Christopher Nolan. In this film, enter the world of dreams as a team of thieves attempt to implant an idea into the subconscious of their target. With stunning visual effects and a mind-bending plot, Inception will leave you questioning reality.",
                'poster_img' => 'images/movies/inception.jpg',
                'duration' => 148,
                'release_date' => Carbon::createFromDate(2010, 7, 14),
                'status' => 'showing_now',
            ],
            [
                'title' => 'The Shawshank Redemption',
                'description' => "Follow the incredible journey of Andy Dufresne in The Shawshank Redemption, a powerful drama about hope and resilience. In this film, Andy, a banker wrongly convicted of murder, forms a bond with his fellow inmates as he plans his escape from Shawshank State Penitentiary. With unforgettable performances and a poignant story, The Shawshank Redemption is a true classic.",
                'poster_img' => 'images/movies/The_Shawshank_Redemption.jpg',
                'duration' => 142,
                'release_date' => Carbon::createFromDate(1994, 10, 14),
                'status' => 'showing_now'
            ],
            [
                'title' => 'Once Upon a Time in Hollywood',
                'description' => "Travel back to the golden age of Hollywood with Quentin Tarantino's Once Upon a Time in Hollywood. Set in 1969 Los Angeles, this film follows struggling actor Rick Dalton and his stunt double Cliff Booth as they navigate a changing industry and encounter the infamous Charles Manson and his followers. With stellar performances and Tarantino's signature style, Once Upon a Time in Hollywood is a love letter to the bygone era of cinema.",
                'poster_img' => 'images/movies/once_upon_a_time_in_hollywood.jpg',
                'duration' => 161,
                'release_date' => Carbon::createFromDate(2019, 7, 26),
                'status' => 'showing_now',
            ],
            [
                'title' => 'Jurassic Park',
                'description' => "Hold on to your seats as Jurassic Park brings dinosaurs back to life in this thrilling adventure film. Join a group of scientists and adventurers as they journey to a remote island theme park filled with genetically engineered dinosaurs. With groundbreaking special effects and heart-pounding action, Jurassic Park is a classic blockbuster.",
                'poster_img' => 'images/movies/jurassic_park.jpg',
                'duration' => 127,
                'release_date' => Carbon::createFromDate(2022, 6, 10),
                'status' => 'showing_now',
            ],
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}
