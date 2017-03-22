<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_author')->unsigned();
            $table->dateTime('post_date');
            $table->text('post_content');
            $table->text('post_title');
            $table->string('post_status', 20)->default('published');
            $table->text('post_structure');
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
        Schema::drop('cms_posts');
    }
}
