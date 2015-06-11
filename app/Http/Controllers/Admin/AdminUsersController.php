<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User\UserStatistics;
use App\Models\User\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

use Carbon\Carbon;

class AdminUsersController extends Controller {

	/**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Role Model
     * @var Role
     */
    protected $role;

    /**
     * Permission Model
     * @var Permission
     */
    protected $permission;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Role $role, Permission $permission)
	{
		$this->middleware('auth');

		$this->user = $user;
        $this->role = $role;
        $this->permission = $permission;

	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		 // Title
        $title = 'User Management';

        // Grab all the users
        $user = $this->user;
        
        $roles = Role::get();

		return view('admin_users/index' , compact('user', 'roles', 'title'));
	}

	/**
     * Show a list of all the users formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getUserdata()
    {
        //$users = $this->user->select('*');

        $users = User::leftjoin('roles', 'roles.id', '=', 'users.role_id')
                    ->select(array('users.id', 'users.first_name','users.email', 'roles.role_title as rolename', 'users.confirmed', 'users.created_at'));


    	return \Datatables::of($users)
        	->addColumn('action', "<button>Edit</button>")
        	->make(true);
    }
    
    /**
     * 
     *
     * @return user statistics View
     */
    public function getUserStatistics()
    {
    	 // Title
        $title = 'User Statistics';
		
        // Grab all the users
        $user = $this->user;
            	
        $yesterday = array(
        		Carbon::now()->subDay()->setTime(00,00,00),
        		Carbon::now()->setTime(00,00,00)
        );
        
        $today = array(
        		Carbon::now()->setTime(00,00,00),
        		Carbon::now()
        );
        
        $stats = UserStatistics::whereBetween('created_at', $today)->orderBy('user_id')->get();
        
        foreach ($stats as $stat){
        	\Debugbar::info($stat->the_user->first_name);
        }
        
    	
    	return view('admin_users/statistics' , compact('user', 'stats', 'title'));
    }
    
    /**
     *
     *
     * @return user statistics View
     */
    public function postUserStatistics(Request $request)
    {
    	
    	$idate = \DateTime::createFromFormat ('d/m/Y H:i:s', $request->input('idate'));
    	$fdate = \DateTime::createFromFormat ('d/m/Y H:i:s', $request->input('fdate'));
    	// Title
    	$title = 'User Statistics';
    
    	// Grab all the users
    	$user = $this->user;
        	 
    	$drange = array(
    			$idate,
    			$fdate
    	);
    
    	$stats = UserStatistics::whereBetween('created_at', $drange)->orderBy('user_id')->get();
    
    	foreach ($stats as $stat){
    		\Debugbar::info($stat->the_user->first_name);
    	}    
    	
    	return view('admin_users/statistics' , compact('user', 'stats', 'title', 'idate', 'fdate'));
    }
}
