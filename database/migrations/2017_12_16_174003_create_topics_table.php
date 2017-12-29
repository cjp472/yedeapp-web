<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration 
{
	public function up()
	{
		Schema::create('topics', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index();
            $table->text('body');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('course_id')->unsigned()->index();
            $table->integer('chapter_id')->unsigned()->index();
            $table->integer('comment_count')->unsigned()->default(0);
            $table->integer('view_count')->unsigned()->default(0);
            $table->integer('order')->unsigned()->default(0);
            $table->tinyInteger('free')->unsigned()->default(0);
            $table->string('slug')->nullable();
            $table->text('desc');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('topics');
	}
}
