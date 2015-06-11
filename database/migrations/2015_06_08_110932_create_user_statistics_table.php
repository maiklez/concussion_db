<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStatisticsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_statistics', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
							
			$table->string('activity');
			
			$table->integer('article')->unsigned()->nullable();
			$table->foreign('article')->references('id')->on('articles');
			
			$table->integer('author')->unsigned()->nullable();
			$table->foreign('author')->references('id')->on('authors');
			$table->integer('user')->unsigned()->nullable();
			$table->foreign('user')->references('id')->on('users');
			
			$table->string('data_type')->nullable();
			$table->string('query')->nullable();
			
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_statistics');
	}

}
