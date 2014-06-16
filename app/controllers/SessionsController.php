<?php

class SessionsController extends \BaseController {



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('sessions.create')->with('title', 'Login');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

        // attempt to log in user
		try
		{
		    // Login credentials
		    $credentials = array(
		        'email' 	=> $input['email'],
		        'password' 	=> $input['password'],
		    );

		    // Authenticate the user
		    if (isset($input['remember-me'])) 
		    {
		    	$user = Sentry::authenticateAndRemember($credentials);
		    }
		    else
		    {
		    	$user = Sentry::authenticate($credentials, false);		    	
		    }

		    // if authentication is successful		    
		    return Redirect::intended('/')->with('flash_message', 'You have been sucessfully logged in.')->with('success', 1);
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    $messages[] = 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		     $messages[] = 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
		    $messages[] = 'Wrong password, try again.';
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    $messages[] = 'User was not found.';
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
		    $messages[] = 'User is not activated.';
		}

		// The following is only required if the throttling is enabled
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
		    $messages[] = 'User is suspended.';
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
		    $messages[] = 'User is banned.';
		}

		return Redirect::to('login')
		->withInput()
		->withErrors($messages)
		->with('flash_message', 'Invalid credentials');

	}


    /**
     * Log user out and destroy user session
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
	{
		//
		Sentry::logout();
		return Redirect::to('login')->with('flash_message', 'You have been logged out');
	}



}
