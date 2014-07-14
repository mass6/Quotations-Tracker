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