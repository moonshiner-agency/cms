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
        Schema::create('moonshinecms_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author')->nullable();
            $table->dateTime('published_at')->default(date("Y-m-d H:i:s"));
            $table->text('main_content')->nullable();
            $table->text('content')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->string('featured_image')->nullable();
            $table->string('post_status', 20)->default('published');
            $table->string('visibility', 20)->default('public');
            $table->string('template');
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
        Schema::drop('moonshinecms_posts');
    }
}
