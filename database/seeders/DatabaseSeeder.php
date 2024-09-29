<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**
         * This code will create 33 books each books will have reviews between 
         * 5 to 30
         */
        Book::factory(33)->create()->each(function($book){
            $numReviews = random_int(5, 30);

            #this numReviews give random number b/w 5 to 30

            Review::factory()->count($numReviews)
            ->good() #this will call the good method in factory to generate good reviews
            ->for($book) #associated with book by setting the book id column
            ->create();
        });

        Book::factory(33)->create()->each(function($book){
            $numReviews = random_int(5, 30);

            Review::factory()->count($numReviews)
            ->average()
            ->for($book)
            ->create();
        });

        Book::factory(34)->create()->each(function($book){
            $numReviews = random_int(5, 30);

            Review::factory()->count($numReviews)
            ->bad()
            ->for($book)
            ->create();
        });
    }
}
