<?php

use Insight\Entities\User;

class BaseController extends Controller {


    /**
     *
     */
    public function __construct()
    {
        // Fetch the User object
        if (Sentry::getUser()){
            $user = User::find(Sentry::getUser()->id);

            // Sharing user variable across all views
            View::share('user', $user);
        }

    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
