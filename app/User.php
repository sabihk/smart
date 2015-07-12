<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'email', 'password', 'birthday', 'phone_number'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];
	
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	
	/**
	 * Get user details
	 *
	 * @param int $user_id
	 * @param null $this_user
	 * @return object
	 */
	public function userDetails($user_id, $this_user = NULL)
	{
		$user = User::select('id', 'first_name', 'last_name', 'email', 'role', 'phone_number', 'birthday');
		
		if (is_null($this_user))
		{
			$user = $user->where('id', '!=', $user_id)->get();
		}
		else
		{
			$user = $user->where('id', $user_id)->first();
		}
		
		return $user;
	}
	
	/**
	 * Update user details
	 *
	 * @param array $fields
	 * @return int
	 */
	public function updateUser($fields)
	{
		$user_id = $fields['user_id'];
		unset($fields['user_id']);
		
		$updated_rows = User::where('id', $user_id)
				->update($fields);
		
		// Return number of rows updated
		return $updated_rows;
	}
	
	/**
	 * Count duplicate fields
	 *
	 * @param string $field_name
	 * @param array $fields
	 * @return int
	 */
	public function duplicateField($field_name, $fields)
	{
		$field_count = User::
			where($field_name, $fields['email'])
			->where('id', '!=', $fields['user_id'])
			->count();
		
		return $field_count;
	}
	
	/**
	 * Soft Delete user
	 *
	 * @param int $user_id
	 * @return int
	 */
	public function deleteUser($user_id)
	{
		$delete_user = User::where('id', $user_id)->delete();
		return $delete_user;
	}

}
