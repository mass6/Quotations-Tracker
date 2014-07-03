<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;


class User extends Eloquent implements UserInterface, RemindableInterface, StaplerableInterface
{

    use EloquentTrait;

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('avatar', [
            'styles' => [
                'medium' => '300x300',
                'thumb' => '100x100'
            ]
        ]);

        parent::__construct($attributes);
    }

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
    //protected $fillable = [];



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

    /**
     * Relationship definition to Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('Profile');
    }

    /**
     * Relationship definition to Item Requests (created_by)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function createdRequests()
    {
        return $this->hasMany('ItemRequest', 'created_by');
    }

    /**
     * Relationship definition to Item Requests (assigned_to)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignedRequests()
    {
        return $this->hasMany('ItemRequest', 'assigned_to');
    }


//    public function user_id()
//    {
//        $this->hasMany('ItemRequest');
//    }

    public function comments()
    {
        return $this->hasMany('Comment');
    }

}
