<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePostTag extends Migration
{
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->unsignedInteger('post_id')->default(0)->index();
            $table->unsignedInteger('tag_id')->default(0)->index();
        });
    }

    public function down()
    {
        Schema::drop('post_tag');
    }
}
