<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all categories and movies
        $categories = Category::all();
        $movies = Movie::all();

        // Assign categories to movies
        foreach ($movies as $movie) {
            // Randomly choose categories to assign to the movie
            $randomCategories = $categories->random(rand(1, 3));

            // Attach each category to the movie
            foreach ($randomCategories as $category) {
                $movie->categories()->attach($category->id);
            }
        }
    }
}
