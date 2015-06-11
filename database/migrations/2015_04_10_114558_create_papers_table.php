<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePapersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('author_id')->unsigned();
			$table->foreign('author_id')->references('id')->on('authors');

			$table->integer('parent_id')->unsigned()->nullable();
			$table->foreign('parent_id')->references('id')->on('articles');

			$table->string('article_title');
			$table->string('journal_title');
			$table->unique(array('article_title','journal_title'));

			$table->integer('year');
			$table->integer('volume')->nullable();
			$table->integer('issue')->nullable();
			$table->integer('page_range_min')->nullable();
			$table->integer('page_range_max')->nullable();
			$table->date('published_online')->nullable();
			$table->string('doi_number');
			$table->string('doi_number_prefix')->nullable();
			$table->string('doi_number_journal')->nullable();
			$table->string('doi_number_year')->nullable();
			$table->string('doi_number_number')->nullable();
			$table->string('crossref_link');

			$table->string('key_finding')->nullable();

			$table->text('design')->nullable();
			$table->text('summary')->nullable();

			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('article_type_pivot', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('article_id')->unsigned();
			$table->foreign('article_id')->references('id')->on('articles');
			$table->integer('list_id')->unsigned();
			$table->foreign('list_id')->references('id')->on('list_article_type');
			$table->unique(array('article_id','list_id'));
		});

		Schema::create('article_class_pivot', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('article_id')->unsigned();
			$table->foreign('article_id')->references('id')->on('articles');
			$table->integer('list_id')->unsigned();
			$table->foreign('list_id')->references('id')->on('list_article_class');
			$table->unique(array('article_id','list_id'));
		});

		Schema::create('conclussions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('article_id')->unsigned();
			$table->foreign('article_id')->references('id')->on('articles');
			$table->text('conclussion');

			$table->timestamps();
		});

		Schema::create('study_results', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('article_id')->unsigned();
			$table->foreign('article_id')->references('id')->on('articles');

			$table->text('result');
			$table->string('image_link')->nullable();

			$table->timestamps();
		});
		
		

		Schema::create('study_objectives', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('article_id')->unsigned();
			$table->foreign('article_id')->references('id')->on('articles');

			$table->text('objective');


			$table->timestamps();
		});

		Schema::create('study_recomendations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('article_id')->unsigned();
			$table->foreign('article_id')->references('id')->on('articles');

			$table->text('recomendations');


			$table->timestamps();
		});

		Schema::create('study_population', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('article_id')->unsigned();
			$table->foreign('article_id')->references('id')->on('articles');

			$table->integer('type_id')->unsigned()->nullable();
			$table->foreign('type_id')->references('id')->on('list_population_type');

			$table->integer('gender_id')->unsigned()->nullable();
			$table->foreign('gender_id')->references('id')->on('list_gender');

			$table->integer('class_id')->unsigned()->nullable();
			$table->foreign('class_id')->references('id')->on('list_population_class');

			$table->timestamps();
		});

		Schema::create('age_ranges', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('population_id')->unsigned();
			$table->foreign('population_id')->references('id')->on('study_population');

			$table->integer('medium')->nullable();
			$table->integer('minimum')->nullable();
			$table->integer('maximum')->nullable();

			$table->string('name')->nullable();

			$table->timestamps();
		});

		Schema::create('sample_sizes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('population_id')->unsigned();
			$table->foreign('population_id')->references('id')->on('study_population');

			$table->integer('size')->nullable();		
			$table->text('option')->nullable();

			$table->timestamps();
		});

		Schema::create('implications_list_pivot', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('article_id')->unsigned();
			$table->foreign('article_id')->references('id')->on('articles');
			$table->integer('list_id')->unsigned();
			$table->foreign('list_id')->references('id')->on('list_implication_study');
			$table->unique(array('article_id','list_id'));
		});

		Schema::create('outcome_list_pivot', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('article_id')->unsigned();
			$table->foreign('article_id')->references('id')->on('articles');
			$table->integer('list_id')->unsigned();
			$table->foreign('list_id')->references('id')->on('list_outcome_measures');
			$table->unique(array('article_id','list_id'));
		});

		Schema::create('coauthors_article', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('author_id')->unsigned();
			$table->foreign('author_id')->references('id')->on('authors');
			$table->integer('article_id')->unsigned();
			$table->foreign('article_id')->references('id')->on('articles');
			$table->unique(array('author_id','article_id'));
		});

		Schema::create('in_reply', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('article_id')->unsigned();
			$table->foreign('article_id')->references('id')->on('articles');
			
			$table->integer('year');
			$table->integer('volume');
			$table->integer('issue')->nullable();
			$table->integer('page_range_min');
			$table->integer('page_range_max');
			$table->string('doi_number');

			$table->timestamps();
		});

		Schema::create('in_reply_authors_pivot', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('in_reply_id')->unsigned();
			$table->foreign('in_reply_id')->references('id')->on('in_reply');
			$table->integer('author_id')->unsigned();
			$table->foreign('author_id')->references('id')->on('authors');
			$table->unique(array('in_reply_id','author_id'));
		});

		Schema::create('in_reply_class_pivot', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('in_reply_id')->unsigned();
			$table->foreign('in_reply_id')->references('id')->on('in_reply');
			$table->integer('list_id')->unsigned();
			$table->foreign('list_id')->references('id')->on('list_article_class');
			$table->unique(array('in_reply_id','list_id'));
		});

		Schema::create('in_reply_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('in_reply_id')->unsigned();
			$table->foreign('in_reply_id')->references('id')->on('in_reply');
			$table->text('comments');

			$table->timestamps();
		});

		Schema::create('authors_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('article_id')->unsigned();
			$table->foreign('article_id')->references('id')->on('articles');
			$table->text('comments');

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
		
		Schema::drop('authors_comments');

		Schema::drop('in_reply_comments');
		Schema::drop('in_reply_class_pivot');
		Schema::drop('in_reply_authors_pivot');
		Schema::drop('in_reply');
		Schema::drop('coauthors_article');
		Schema::drop('outcome_list_pivot');	
		Schema::drop('implications_list_pivot');
		Schema::drop('sample_sizes');
		Schema::drop('age_ranges');
		Schema::drop('study_population');
		Schema::drop('study_recomendations');

		Schema::drop('study_objectives');
		
		Schema::drop('study_results');
		Schema::drop('conclussions');
		Schema::drop('article_class_pivot');
		Schema::drop('article_type_pivot');	

		Schema::drop('articles');

	}

}
