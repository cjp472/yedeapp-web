<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;
use App\Models\Book;
use App\Models\Chapter;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        // Get all users' id.
        $user_ids = User::all()->pluck('id')->toArray();

        // Get all books' id.
        $book_ids = Book::all()->pluck('id')->toArray();

        // Get all chapters' id.
        $chapter_ids = Chapter::all()->pluck('id')->toArray();

        $faker = app(Faker\Generator::class);

        $topics = factory(Topic::class)
        ->times(50)
        ->make()
        ->each(function ($topic, $index) use ($user_ids, $book_ids, $chapter_ids, $faker) {
            // Get random id from ids array.
            $topic->user_id = $faker->randomElement($user_ids);
            $topic->chapter_id = $faker->randomElement($chapter_ids);
            $topic->book_id = $faker->randomElement($book_ids);
        });

        Topic::insert($topics->toArray());
    }

}

