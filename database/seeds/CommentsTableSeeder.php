<?php

use Illuminate\Database\Seeder;
use App\Comment;
use App\Topic;
use App\User;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);

        $user_ids = User::all()->pluck('id')->toArray();
        $topic_ids = Topic::all()->pluck('id')->toArray();

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
