<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;


class User extends BaseModel implements UserInterface, RemindableInterface {


    /**
     * Defined attributes that may not be mass-assigned
     *
     * @var array
     */
	protected $guarded = ['id'];

    /**
     * Defined attributes that may be mass-assigned
     *
     * @var array
     */
    protected $fillable = [];



    /**
     * Attribute validation rules
     *
     * @var array
     */
	public static $rules = [
		'email'		 => 'required|email',
		'first_name' =>	'required',
		'last_name'	 =>	'required',
		'password'   => 'confirmed',
	];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

    public function assignedRequests()
    {
        return $this->hasMany('ItemRequest', 'assigned_to');
    }

    public function createdRequests()
    {
        return $this->hasMany('ItemRequest', 'created_by');
    }


    public function user_id()
    {
        $this->hasMany('ItemRequest');
    }

}
