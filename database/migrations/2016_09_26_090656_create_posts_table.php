<?php

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
		Schema::create('posts', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->default(0)->index();
            $table->unsignedInteger('user_id')->default(0)->index();
            $table->string('title')->index()->default('')->unique();
            $table->text('content');
            $table->text('content_origin');
            $table->string('description')->default('');
            $table->unsignedInteger('view_count')->default(0)->index();
            $table->unsignedInteger('sort')->default(0)->index();
            $table->timestamp('published_at');
            $table->softDeletes();
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
		Schema::drop('posts');
	}

}
