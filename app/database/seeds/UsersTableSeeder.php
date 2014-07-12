<?php
use Insight\Entities\User;
/**
 *
 */
class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::truncate();

        $users = array();

        $adminUser = Sentry::createUser(array(
            'email'     	=> 'samcharmy@gmail.com',
            'password'  	=> 'sc121212',
            'first_name'	=> 'Sam',
            'last_name'		=> 'Ciaramilaro',
            'activated' 	=> true,
        ));

        $users[] = Sentry::createUser(array(
            'email'			=>	'hayley@test.com',
            'first_name'	=>	'Hayley',
            'last_name'		=>	'Farmer',
            'password'		=>	'1234',
            'activated' 	=> 	true,
        ));

        $users[] = Sentry::createUser(array(
            'email'			=>	'jess@test.com',
            'first_name'	=>	'Jess',
            'last_name'		=>	'Richards',
            'password'		=>	'1234',
            'activated' 	=> 	true,
        ));

        $users[] = Sentry::createUser(array(
            'email'			=>	'wasim@test.com',
            'first_name'	=>	'Wasim',
            'last_name'		=>	'Almasri',
            'password'		=>	'1234',
            'activated' 	=> 	true,
        ));

        // Assign users to groups

        // Find the group using the group id
        $adminGroup = Sentry::findGroupById(1);
        $moderatorGroup = Sentry::findGroupById(2);

        // Assign the group to the user
        $adminUser->addGroup($adminGroup);

        foreach ($users as $user) {
            $user->addGroup($moderatorGroup);
        }

    }
}