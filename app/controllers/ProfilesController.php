<?php
use Insight\Entities\Profile;
use Insight\Entities\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfilesController extends \BaseController
{

	public function forgotPassword()
	{
		return View::make('sessions.forgot-password');
	}

    public function sendResetCode()
    {
        # Response Data Array
        $resp = array();

        // Fields Submitted
        $email = $_POST["email"];

        // This array of data is returned for demo purpose, see assets/js/neon-forgotpassword.js
        $resp['submitted_data'] = $_POST;


        try
        {
            // Find the user using the user email address
            $user = Sentry::findUserByLogin($email);

            // Get the password reset code
            $token = $user->getResetPasswordCode();
            $data = array('user' => $user,'token' => $token);

            Mail::send('emails.auth.reminder', $data, function($message) use ($data)
            {
                $message->to($data['user']['email'], $data['user']['first_name'] )->subject('Password Reset Request');
            });

            //return Redirect::to('login')->with('flash_message', 'Reset link sent to ' . $user['email'])->with('success', true);

            return Response::json($resp);

        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            //return Redirect::route('forgotpassword')->with('flash_message', 'User was not found.');
            return Response::json($resp);
        }
    }


	public function requestResetPassword()
	{
		$email = Input::get('email');

		try
		{
		    // Find the user using the user email address
			$user = Sentry::findUserByLogin($email);
		    
		    // Get the password reset code
    		$token = $user->getResetPasswordCode();
    		$data = array('user' => $user,'token' => $token);

    		Mail::send('emails.auth.reminder', $data, function($message) use ($data)
			{
			    $message->to($data['user']['email'], $data['user']['first_name'] )->subject('Password Reset Request');
			});

    		return Redirect::to('login')->with('flash_message', 'Reset link sent to ' . $user['email'])->with('success', true);

		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::route('forgotpassword')->with('flash_message', 'User was not found.');
		}
	}

	public function resetPassword($token)
	{
		//return $token;

		try
		{
		    $user = Sentry::findUserByResetPasswordCode($token);
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::to('login')->with('flash_message', 'Reset token is invalid or has expired.');
		}
		    
		//return View::make('profiles.resetpassword', compact(['user', 'token']));
		return View::make('sessions.reset-password', compact(['user', 'token']));

		// try
		// {
		//     // Find the user using the user id
		//     $user = Sentry::findUserById(1);

		//     // Check if the reset password code is valid
		//     if ($user->checkResetPasswordCode('8f1Z7wA4uVt7VemBpGSfaoI9mcjdEwtK8elCnQOb'))
		//     {
		//         // Attempt to reset the user password
		//         if ($user->attemptResetPassword('8f1Z7wA4uVt7VemBpGSfaoI9mcjdEwtK8elCnQOb', 'new_password'))
		//         {
		//             // Password reset passed
		//         }
		//         else
		//         {
		//             // Password reset failed
		//         }
		//     }
		//     else
		//     {
		//         // The provided password reset code is Invalid
		//     }
		// }
		// catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		// {
		//     echo 'User was not found.';
		// }
	}


	public function updatePassword($userId, $token)
	{

		$input = Input::all();

		$validation = Validator::make(
		    array(
		        'password' 				=> $input['password'],
		        'password_confirmation'	=> $input['password_confirmation'],
		    ),
		    array(
		        'password' 	=> 'required|min:8|confirmed',
		    )
		);
		
		if ($validation->passes())
		{
			$user = Sentry::findUserById($userId);
			
			// Attempt to reset the user password
	        if ($user->attemptResetPassword($token, $input['password']))
	        {
	            return Redirect::to('login')->with('flash_message', 'Password updated!')->with('success', true);
	        }
	        else
	        {
	            return Redirect::back()->with('flash_message', 'Password not saved! Please try again.');
	        }
		}
		else
		{
	      return Redirect::back()
	      ->withErrors($validation)
	      ->with('flash_message', 'There were validation errors. Please try again.');
		}
	}

    public function show($id)
    {
        try
        {
            $user = User::with('profile')->findOrFail($id);
            if (! $user->profile){
                $user->profile = new Profile;
                $user->profile()->save($user->profile);
            }
        }
        catch(ModelNotFoundException $e)
        {
            return Redirect::route('home');
        }
        return View::make('users.profiles.show', compact('user'));
    }

    public function edit($id)
    {
        try
        {
            $user = User::findOrFail($id);
            if (! $user->profile){
                $user->profile = new Profile;
                $user->profile()->save($user->profile);
            }
        }
        catch(ModelNotFoundException $e)
        {
            return Redirect::route('home');
        }

        return View::make('profiles.edit', compact('user'));
    }

    public function update($id)
    {
        $user = User::findOrFail($id);
        $input = Input::all();

        if (! $user->profile->fill($input)->save())
        {

            return Redirect::back()->withInput()->withErrors($user->profile->getErrors())
                ->with('flash_message', 'There were validation issues.')
                ->with('success', false)
                ->with('validationfailed', true);
        }
        else
        {
            return Redirect::route('profile.show', $id)
                ->with('flash_message', 'You profile was successfully updated.')
                ->with('success', true);
        }


    }


}