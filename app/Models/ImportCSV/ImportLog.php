<?php namespace App\Models\ImportCSV;

use Illuminate\Database\Eloquent\Model;

class ImportLog extends Model {

	protected $table = 'import_log';

	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['action', 'article_title', 'cell_type', 'cell_value', 'text_error'];

	/**
	 * article() one-to-many relationship method
	 * 
	 * @return QueryBuilder
	 */
	public function csv()
	{
		return $this->belongsTo('App\Models\ImportCSV\ImportCSV', 'csv_id');
	}

}
