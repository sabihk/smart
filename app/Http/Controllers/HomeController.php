<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 * If admin show all users
	 * Else show login message
	 *
	 * @return response
	 */
	public function index()
	{
		$user_role = (int)\Auth::user()->role;
		$user_id = \Auth::user()->id;
		
		$user = new User();
		$user_details = $user->userDetails($user_id);
		
		return view('home')
			->with('user_role', $user_role)
			->with('user_details', $user_details);
	}
	
	/**
	 * Update user role
	 *
	 * @return int
	 */
	public function postUserRole()
	{
		if (\Request::ajax())
		{
			$fields = \Request::all();
			unset($fields['_token']);
			
			$user = new User();
			$affected_rows = $user->updateUser($fields);
			
			return $affected_rows;
		}
	}

	/**
	 * Get user details
	 *
	 * @return response
	 */
	public function getEditUser()
	{
		if (\Request::ajax())
		{
			$user_id = \Request::input('user_id');
			
			$user = new User();
			$user_details = $user->userDetails($user_id, $this_user = TRUE);
			
			return view('editUserDetails')
				->with('user_details', $user_details);
		}
	}
	
	/**
	 * Update user details
	 *
	 * @return response
	 */
	public function postUpdateUserDetails()
	{
		$fields = \Request::all();
		unset($fields['_token']);
		
		// Modifying date from mm-dd-yyyy to yyyy-mm-dd (as per MySql)
		$fields['birthday'] = date('Y-m-d', strtotime($fields['birthday']));
		
		$user = new User();
		$affected_rows = $user->updateUser($fields);
		
		if($affected_rows == 1)
		{	
			return redirect()->back()->with('success', 'User details updated successfully');
		}
		else
		{
			return redirect()->back()->with('error', 'Error occurred!');
		}
	}
	
	/**
	 * Check duplicate email
	 *
	 * @return int
	 */
	public function getDuplicateEmail()
	{
		if (\Request::ajax())
		{
			$fields = \Request::all();
			$field_name = 'email';
			
			$user = new User();
			$field_exist = $user->duplicateField($field_name, $fields);
			
			return $field_exist;
		}
	}
	
	/**
	 * Soft Delete user
	 *
	 * @return int
	 */
	public function postDeleteUser()
	{
		if (\Request::ajax())
		{
			$user_id = \Request::input('user_id');
			
			$user = new User();
			$deleted_user = $user->deleteUser($user_id);
			
			return $deleted_user;
		}
	}
}
