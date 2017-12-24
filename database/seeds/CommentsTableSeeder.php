<?php

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Topic;
use App\Models\User;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all users' id.
        $user_ids = User::all()->pluck('id')->toArray();

        // Get all topics' id.
        $topic_ids = Topic::all()->pluck('id')->toArray();

        $faker = app(Faker\Generator::class);

        $comments = factory(Comment::class)
        ->times(2000)
        ->make()
        ->each(function ($comment, $index) use ($user_ids, $topic_ids, $faker) {
            // Get random id from ids array.
            $comment->user_id = $faker->randomElement($user_ids);
            $comment->topic_id = $faker->randomElement($topic_ids);
        });

        Comment::insert($comments->toArray());
    }
}
