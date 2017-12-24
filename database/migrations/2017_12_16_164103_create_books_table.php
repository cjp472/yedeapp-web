<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index()->comment('书名');
            $table->string('slug')->index()->comment('SEO');
            $table->string('cover')->nullable()->comment('封面');
            $table->text('brief')->nullable()->comment('描述');
            $table->text('preface')->nullable()->comment('简介');
            $table->integer('chapter_count')->unsigned()->default(0)->comment('章数');
            $table->float('price')->unsigned()->default(0)->comment('售价');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
