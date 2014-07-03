<?php

class SessionsController extends \BaseController {



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('sessions.login')->with('title', 'Login');
	}

    public function authenticate()
    {
        /*
	    Sample Processing of Forgot password form via ajax
	    Page: extra-register.html
        */

        $data = Session::all();
        Log::info($data);

        # Response Data Array
        $resp = array();


        // Fields Submitted
        $email = $_POST["username"];
        $password = $_POST["password"];


        // This array of data is returned for demo purpose, see assets/js/neon-forgotpassword.js
        $resp['submitted_data'] = $_POST;


        // Login success or invalid login data [success|invalid]
        // Your code will decide if username and password are correct
        $login_status = 'invalid';
//        $newuser = Sentry::authenticate(array(
//            'email' => 'samcharmy@gmail.com',
//            'passsword' => 'sc121212'
//        ));
//        Log::info($newuser);
        // attempt to log in user
        try
        {
            // Login credentials
            $credentials = array(
                'email' 	=> $email,
                'password' 	=> $password,
            );
            Log::info('login credentials below');
            Log::info($credentials);

            // Authenticate the user
            $user = Sentry::authenticate($credentials);
            Log::info($user);
            $login_status == 'success';
            $resp['login_status'] = 'success';
            // Set the redirect url after successful login
            $resp['redirect_url'] = Session::get('url')['intended'];
            return Response::json($resp);

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

        // if authentication is fails
        if (!isset($user)){
            Log::info('no user found');
            $login_status = 'invalid';
            $resp['login_status'] = $login_status;
            return Response::json( $resp );
        }

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
