<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{

	public function up()
	{
		Schema::create('logs', function(Blueprint $table) {
            $table->increments('id');

            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('logs');
	}
}
