<?php

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Chapter;

class ChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all books' id.
        $book_ids = Book::all()->pluck('id')->toArray();

        $faker = app(Faker\Generator::class);

        $chapters = factory(Chapter::class)
        ->times(15)
        ->make()
        ->each(function ($chapter, $index) use ($book_ids, $faker) {
            // Get random id from ids array.
            $chapter->book_id = $faker->randomElement($book_ids);
        });

        Chapter::insert($chapters->toArray());
    }
}
