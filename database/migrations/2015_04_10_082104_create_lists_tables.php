<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('list_article_type', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('parent_id')->unsigned()->nullable();
			$table->foreign('parent_id')->references('id')->on('list_article_type');
			$table->string('name');
			$table->boolean('has_children');
		});

		Schema::create('list_article_class', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('parent_id')->unsigned()->nullable();
			$table->foreign('parent_id')->references('id')->on('list_article_class');
			$table->string('name');
			$table->boolean('has_children');
		});

		Schema::create('list_population_type', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('parent_id')->unsigned()->nullable();
			$table->foreign('parent_id')->references('id')->on('list_population_type');
			$table->string('name');
			$table->boolean('has_children');

		});

		Schema::create('list_population_class', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('parent_id')->unsigned()->nullable();
			$table->foreign('parent_id')->references('id')->on('list_population_class');
			$table->string('name');
			$table->boolean('has_children');

		});

		Schema::create('list_gender', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('parent_id')->unsigned()->nullable();
			$table->foreign('parent_id')->references('id')->on('list_gender');
			$table->string('name');
			$table->boolean('has_children');

		});

		Schema::create('list_implication_study', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('parent_id')->unsigned()->nullable();
			$table->foreign('parent_id')->references('id')->on('list_implication_study');
			$table->string('name');
			$table->boolean('has_children');
		});

		Schema::create('list_outcome_measures', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('parent_id')->unsigned()->nullable();
			$table->foreign('parent_id')->references('id')->on('list_outcome_measures');
			$table->string('name');
			$table->boolean('has_children');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('list_outcome_measures');

		Schema::drop('list_implication_study');
		Schema::drop('list_gender');
		Schema::drop('list_population_class');

		Schema::drop('list_population_type');
		Schema::drop('list_article_class');
		Schema::drop('list_article_type');

	}

}
