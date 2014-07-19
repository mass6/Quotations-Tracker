<?php
use Insight\Entities\User;
use Insight\Entities\Profile;
use Insight\Entities\Customer;

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
        $customers = Customer::lists('name', 'code');
        $customers[''] = "N/A";
		return View::make('users.create', compact('groups', 'customers'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$input = Input::all();
        if ($input['type'] == 2)
            $input['customer'] = $input['customer'];
        else $input['customer'] = null;
        User::$rules['password'] = 'required|confirmed';
		$validation = Validator::make($input, User::$rules);
		if ($validation->passes())
		{
		   $newuser = Sentry::createUser(array(
		   		'first_name'	=> $input['first_name'],
		   		'last_name'		=> $input['last_name'],
		   		'email'			=> $input['email'],
		   		'password'	    => $input['password'],
		   		'type'	        => $input['type'],
		   		'customer'	    => $input['customer'],
		   		'activated'		=> true,
		   	));

            // update group memberships
            if (! isset($input['group_membership']))
            {
                $input['group_membership'] = array();
            }
            $this->updateGroupMemberships($newuser, $input['group_membership']);

           Profile::create(['user_id' => $newuser->id]);

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
        $customers = Customer::lists('name', 'code');
        return View::make('users.edit')
		->with('user', $user)
        ->with('customers', $customers)
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
            $user->type = $input['type'];
            if ($input['type'] == 2)
             $user->customer = $input['customer'];
            else $user->customer = null;

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
