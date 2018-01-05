<?php

use Illuminate\Database\Seeder;
use App\Topic;
use App\User;
use App\Course;
use App\Chapter;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = app(Faker\Generator::class);

        $user_ids = User::all()->pluck('id')->toArray();
        $course_ids = Course::all()->pluck('id')->toArray();
        $chapter_ids = [1,2];

        $topics = factory(Topic::class)
        ->times(50)
        ->make()
        ->each(function ($topic, $index) use ($user_ids, $course_ids, $chapter_ids, $faker) {
            // Get random id from ids array.
            $topic->user_id = $faker->randomElement($user_ids);
            $topic->course_id = $faker->randomElement($course_ids);
            $topic->chapter_id = $faker->randomElement($chapter_ids);
        });

        Topic::insert($topics->toArray());
    }

}

