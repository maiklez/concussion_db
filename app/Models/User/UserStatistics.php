<?php namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article\Article;
use Debugbar;


class UserStatistics extends Model  {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_statistics';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'activity', 'data_type', 'query'];
	
	public static $ACTIVITIES = ['log_in', 'log_out', 'search', 'list', 'save', 'upload'];
								//0			1			2		3		4		5
	public static $DATA_TYPES = ['article', 'user', 'author' ,'implications', ''];
	
	
	
	/**
	 * role() one-to-many relationship method
	 *
	 * @return QueryBuilder
	 */
	public function the_user()
	{
		return $this->belongsTo('App\Models\User\User', 'user_id', 'id');
	}
	
	/**
	 * role() one-to-many relationship method
	 *
	 * @return QueryBuilder
	 */
	public function article_worked()
	{
		return $this->belongsTo('App\Models\Article\Article', 'article');
	}
	
	/**
	 * role() one-to-many relationship method
	 *
	 * @return QueryBuilder
	 */
	public function author_worked()
	{
		return $this->belongsTo('App\Models\Author\Author', 'author');
	}
	
	/**
	 * role() one-to-many relationship method
	 *
	 * @return QueryBuilder
	 */
	public function user_worked()
	{
		return $this->belongsTo('App\Models\User\User', 'user');
	}
	
	public function getDates()
	{
		return ['created_at'];
	}
	
	
	public static function logInUser(User $user){
		$stat = new UserStatistics(['activity' => 'log_in' ]);		
		$user->statistics()->save($stat);
	}
	
	public static function logOutUser(User $user){
		$stat = new UserStatistics(['activity' => 'log_out' ]);
		$user->statistics()->save($stat);
	}
	
	public static function search(User $user, $data_type, $query){
		$stat = new UserStatistics(['activity' => 'search', 'data_type'=> $data_type, 'query'=> $query ]);
		
		$user->statistics()->save($stat);
	}
	
	public static function uslist(User $user, $id, $data_type, $query=null){
		$stat = new UserStatistics(['activity' => 'list', 'data_type'=> $data_type,'query'=> $query ]);
		
		if($data_type=='article') $stat->article = $id;
		elseif($data_type=='author') $stat->author = $id;
		elseif($data_type=='user') $stat->user = $id;
		
		$user->statistics()->save($stat);
	}
	
	public static function ussave(User $user, $id, $data_type, $query=null){
		$stat = new UserStatistics(['activity' => 'save', 'data_type'=> $data_type,'query'=> $query ]);
	
		if($data_type=='article') $stat->article = $id;
		elseif($data_type=='author') $stat->author = $id;
		elseif($data_type=='user') $stat->user = $id;
	
		$user->statistics()->save($stat);
	}
	public static function usupdate(User $user, $id, $data_type, $query=null){
		$stat = new UserStatistics(['activity' => 'update', 'data_type'=> $data_type,'query'=> $query ]);
	
		if($data_type=='article') $stat->article = $id;
		elseif($data_type=='author') $stat->author = $id;
		elseif($data_type=='user') $stat->user = $id;
	
		$user->statistics()->save($stat);
	}
}
