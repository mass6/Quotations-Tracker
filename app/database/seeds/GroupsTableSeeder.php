<?php

/**
* 
*/
class GroupsTableSeeder extends Seeder
{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		DB::table('groups')->truncate();
		
		Sentry::createGroup(array(
	        'name'        => 'Administrator',
	        'permissions' => array(
	            'admin' => 1,
	            'users' => 1,
	        ),
	    ));

	    Sentry::createGroup(array(
	        'name'        => 'Members',
	        'permissions' => array(
                'reports' => 1,
                'item_requests' => 1,
	        ),
	    ));

        Sentry::createGroup(array(
            'name'        => 'Emrill',
            'permissions' => array(
                'reports' => 1,
                'item_requests' =>0,
            ),
        ));

	}
}