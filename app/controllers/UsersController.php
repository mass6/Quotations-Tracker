<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();

		return View::make('users.index', compact('users'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$groups = Sentry::findAllGroups();
		return View::make('users.create')
		->with('groups');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$input = Input::all();
        User::$rules['password'] = 'required|confirmed';
		$validation = Validator::make($input, User::$rules);
        Log::info('test');
		if ($validation->passes())
		{
		   $user = Sentry::createUser(array(
		   		'first_name'	=> $input['first_name'],
		   		'last_name'		=> $input['last_name'],
		   		'email'			=> $input['email'],
		   		'password'	    => $input['password'],
		   		'activated'		=> true,
		   	));

           Profile::create(['user_id' => $user->id]);

		   return Redirect::route('admin.users.index')
		   		->with('flash_message', 'User was successfully added')
		   		->with('success', true);
		}
		return Redirect::route('admin.users.create')
		   ->withInput()
		   ->withErrors($validation)
		   ->with('flash_message', 'There were validation errors.');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		return View::make('users.edit')
		->with('user', $user)
		->with('membership', getGroupMemberships($user->id, 'id'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $user = User::find($id);
        $input = Input::all();

        $validation = Validator::make($input, User::$rules);
        if ($validation->passes())
        {
            $user->email = $input['email'];
            $user->first_name = $input['first_name'];
            $user->last_name = $input['last_name'];
            $user->avatar = $input['avatar'];

            // check if password was updated
            if ($input['password'] && $input['password_confirmation'])
            {
                $user->password = $input['password'];
            }

            $user->save();

            // update group memberships
            $sentryUser = Sentry::findUserById($id);
            if (! isset($input['group_membership']))
    		{
    			$input['group_membership'] = array();
    		}
    		$this->updateGroupMemberships($sentryUser, $input['group_membership']);

			// return to users index
			return Redirect::route('admin.users.index')
		   		->with('flash_message', 'User successfully updated.')
		   		->with('success', true);

		}

		return Redirect::route('admin.users.edit', $id)
		   ->withInput()
		   ->withErrors($validation)
		   ->with('flash_message', 'There were validation errors.');

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		try
		{
		    // Find the user using the user id
		    $user = Sentry::findUserById($id);

		    // Delete the user
		    $user->delete();
		    return Redirect::route('admin.users.index')
		    ->with('flash_message', 'User was successfully deleted.')
		    ->with('success', true);

		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    echo 'User was not found.';
		}
	}

	protected function updateGroupMemberships($user, array $groupIds)
	{
		//dd($groupIds);

			
		// Get the user current group memberships
		$groups = $user->getGroups();
		
		// initialize variable to store group IDs
		$currentGroupMemberships = array();

		//convert to simple array
		foreach ($groups as $group) 
		{
			$currentGroupMemberships[] = $group['id'];			
		}

		// are changes requested?
		if ($currentGroupMemberships != $groupIds)
		{
			// get all groups
			$userGroups = Sentry::findAllGroups();

			foreach ($userGroups as $userGroup) 
			{
				if (in_array($userGroup->id, $groupIds)) 
				{
					$user->addGroup($userGroup);
				}
				else
				{
					$user->removeGroup($userGroup);
				}
			}
			return true;

		}
		else return false;
	}


}
