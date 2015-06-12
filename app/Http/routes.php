<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('/home', ['uses' => 'HomeController@index', 'as' => 'home']);
Route::get('/contact_us', ['uses' => 'HomeController@contact_us', 'as' => 'contact_us']);

// Protected Routes by auth and acl middleware
Route::group(['prefix' => 'admin_users', 'namespace' => 'Admin', 'middleware' => ['auth', 'acl']], function() use ($router)
{
	Route::get('index', [
		'uses' => 'AdminUsersController@index',
		'permission' => 'can_users',

	]);

	Route::get('/page_b', [
		'uses' => 'HomeController@page_b',
		'permission' => 'can_users'	
	]);
	
	Route::get('statistics', [
			'uses' => 'AdminUsersController@getUserStatistics',
			'permission' => 'can_users',
	
	]);
	
	Route::post('statistics', [
			'uses' => 'AdminUsersController@postUserStatistics',
			'permission' => 'can_users',
	
	]);

});

//ARTICLES Protected Routes by auth and acl middleware
Route::group(['prefix' => 'articles', 'namespace' => 'Articles', 'middleware' => ['auth', 'acl']], function() use ($router)
{
	Route::get('index', [
		'uses' => 'ArticlesController@index',
		'permission' => 'can_articles',
	]);

	Route::get('import', [
		'uses' => 'ArticlesController@getImport',
		'permission' => 'can_articles',
	]);

	Route::get('/{id}/show', [
		'uses' => 'ArticlesController@getArticle',
		'permission' => 'can_articles'	
	]);

	//COAUTHOR
	Route::get('/{id}/author', [
		'uses' => 'ArticlesController@getAuthorsArticle',
		'permission' => 'can_articles'	
	]);	

	Route::post('/{id}/addcoauthor', [
		'uses' => 'ArticlesController@postAddCoauthor',
		'permission' => 'can_articles'	
	]);
	Route::get('/{article_id}/{coauthor_id}/destroycoauthor', [
		'uses' => 'ArticlesController@destroyCoauthor',
		'permission' => 'can_articles'	
	]);
//------------------------------

	//IMPLICATIONS
	Route::get('/{id}/implications', [
		'uses' => 'ArticlesController@getImplicationsArticle',
		'permission' => 'can_articles'	
	]);	

	Route::post('/{id}/addimplication', [
		'uses' => 'ArticlesController@postAddImplication',
		'permission' => 'can_articles'	
	]);
	Route::get('/{article_id}/{implication_id}/destroyimplication', [
		'uses' => 'ArticlesController@destroyImplication',
		'permission' => 'can_articles'	
	]);
//------------------------------

//Outcome Measures
	Route::get('/{id}/measures', [
		'uses' => 'ArticlesController@getMeasuresArticle',
		'permission' => 'can_articles'	
	]);	

	Route::post('/{id}/addmeasure', [
		'uses' => 'ArticlesController@postAddMeasure',
		'permission' => 'can_articles'	
	]);
	Route::get('/{article_id}/{measure_id}/destroymeasure', [
		'uses' => 'ArticlesController@destroyMeasure',
		'permission' => 'can_articles'	
	]);


//------------------------------

	//OBJECTIVES
	Route::get('/{id}/objectives', [
		'uses' => 'ArticlesController@getObjectivesArticle',
		'permission' => 'can_articles'	
	]);

	Route::post('/{id}/addobjective', [
		'uses' => 'ArticlesController@postAddObjective',
		'permission' => 'can_articles'	
	]);
	Route::get('/{article_id}/{objective_id}/destroyobjective', [
		'uses' => 'ArticlesController@destroyObjective',
		'permission' => 'can_articles'	
	]);
//------------------------------


	//in Reply
	Route::get('/{id}/inreply', [
		'uses' => 'ArticlesController@getInReplyArticle',
		'permission' => 'can_articles'	
	]);	

	Route::get('/{id}/inreply/select_article', [
		'uses' => 'ArticlesController@getInReplySelectArticle',
		'permission' => 'can_articles'	
	]);

	Route::get('/{article_id}/inreply/{result_id}/select_article', [
		'uses' => 'ArticlesController@selectArticle',
		'permission' => 'can_articles'	
	]);

	Route::post('/{id}/updateinreply', [
		'uses' => 'ArticlesController@postUpdateInReply',
		'permission' => 'can_articles'	
	]);

	Route::post('/{id}/inreply/addcomment', [
		'uses' => 'ArticlesController@postAddCommentInReply',
		'permission' => 'can_articles'	
	]);

	Route::get('/{article_id}/inreply/{inreplycomment}/destroyinreplycomment', [
		'uses' => 'ArticlesController@destroyInReplyComment',
		'permission' => 'can_articles'	
	]);
//------------------------------

	Route::get('/create', [
		'uses' => 'ArticlesController@getCreate',
		'permission' => 'can_articles'	
	]);
	Route::post('/create', [
		'uses' => 'ArticlesController@postCreate',
		'permission' => 'can_articles'	
	]);

	Route::get('/{id}/edit', [
		'as' => 'articles.edit',
		'uses' => 'ArticlesController@getEdit',
		'permission' => 'can_articles'	
	]);

	Route::post('/{id}/edit', [
		'uses' => 'ArticlesController@postEdit',
		'permission' => 'can_articles'	
	]);

	Route::get('/{id}/destroy', [
		'as' => 'articles.destroy',
		'uses' => 'ArticlesController@destroy',
		'permission' => 'can_articles'	
	]);

	

});

//AUTHORS Protected Routes by auth and acl middleware
Route::group(['prefix' => 'authors', 'namespace' => 'Articles', 'middleware' => ['auth', 'acl']], function() use ($router)
{
	Route::get('index', [
		'uses' => 'AuthorsController@index',
		'permission' => 'can_articles',
	]);

	Route::get('/{id}/show', [
		'uses' => 'AuthorsController@getAuthor',
		'permission' => 'can_articles'	
	]);

	Route::get('/create', [
		'uses' => 'AuthorsController@getCreate',
		'permission' => 'can_articles'	
	]);
	Route::post('/create', [
		'as' => 'authors.create',
		'uses' => 'AuthorsController@postCreate',
		'permission' => 'can_articles'	
	]);

	Route::get('/{id}/edit', [
		'as' => 'authors.edit',
		'uses' => 'AuthorsController@getEdit',
		'permission' => 'can_articles'	
	]);

	Route::post('/{id}/edit', [
		'uses' => 'AuthorsController@postEdit',
		'permission' => 'can_articles'	
	]);
	
	Route::post('/{id}/addaffiliation', [
			'uses' => 'AuthorsController@postAddAffiliations',
			'permission' => 'can_articles'
	]);
	
	Route::get('/{id}/destroy', [
		'as' => 'authors.destroy',
		'uses' => 'AuthorsController@destroy',
		'permission' => 'can_articles'	
	]);

});

//AUTHORS Protected Routes by auth and acl middleware
Route::group(['prefix' => 'import', 'namespace' => 'Articles', 'middleware' => ['auth', 'acl']], function() use ($router)
{
	Route::get('results', [
		'uses' => 'ArticlesController@getImportResults',
		'permission' => 'can_articles',
	]);

	Route::get('/{id}/file_results', [
		'uses' => 'ArticlesController@getImportFileResults',
		'permission' => 'can_articles',
	]);

});

//Route::model('authors', 'Author');
//Route::resource('authors', 'Articles\AuthorsController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'admin_users' => 'Admin\AdminUsersController',
	'articles' => 'Articles\ArticlesController',
]);

Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'RegistrationController@confirm'
]);

//dropdowns ajax
Route::get('/lists/get_subpopulation_type', [
		'as' => 'subpopulation_type',
		'uses' => 'Articles\ListsController@getPopulationTypeList',
		'permission' => 'can_articles'	
	]);
Route::get('/lists/get_subpopulation_class', [
		'as' => 'subpopulation_class',
		'uses' => 'Articles\ListsController@getPopulationClassList',
		'permission' => 'can_articles'	
	]);