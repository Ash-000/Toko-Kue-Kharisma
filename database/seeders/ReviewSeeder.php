<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        // Customer reviews removed
        $reviews = [];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
