<?php

namespace Database\Seeders;

use App\Models\Actor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actors = [
            ['name' => 'Christian Bale', 'profile_img' => 'images/actors/christian_bale.jpg', 'nationality' => 'British'],
            ['name' => 'Heath Ledger', 'profile_img' => 'images/actors/heath_ledger.jpg', 'nationality' => 'Australian'],
            ['name' => 'Ryan Reynolds', 'profile_img' => 'images/actors/ryan_reynolds.jpg', 'nationality' => 'Canadian'],
            ['name' => 'Robert Downey Jr.', 'profile_img' => 'images/actors/robert_downey_jr.jpg', 'nationality' => 'American'],
            ['name' => 'Al Pacino', 'profile_img' => 'images/actors/al_pacino.jpg', 'nationality' => 'American'],
            ['name' => 'Marlon Brando', 'profile_img' => 'images/actors/marlon_brando.jpg', 'nationality' => 'American'],
            ['name' => 'Leonardo DiCaprio', 'profile_img' => 'images/actors/leonardo_dicaprio.jpg', 'nationality' => 'American'],
            ['name' => 'Morgan Freeman', 'profile_img' => 'images/actors/morgan_freeman.jpg', 'nationality' => 'American'],
            ['name' => 'Brad Pitt', 'profile_img' => 'images/actors/brad_pitt.jpg', 'nationality' => 'American'],
            ['name' => 'Tom Hanks', 'profile_img' => 'images/actors/tom_hanks.jpg', 'nationality' => 'American'],
            ['name' => 'Quentin Tarantino', 'profile_img' => 'images/actors/quentin_tarantino.jpg', 'nationality' => 'American'],
            ['name' => 'Margot Robbie', 'profile_img' => 'images/actors/margot_robbie.jpg', 'nationality' => 'Australian'],
            ['name' => 'Tom Cruise', 'profile_img' => 'images/actors/tom_cruise.jpg', 'nationality' => 'American'],
        ];

        foreach ($actors as $actor) {
            Actor::create($actor);
        }
    }
}
