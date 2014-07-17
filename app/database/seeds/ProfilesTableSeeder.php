<?php
use Insight\Entities\Profile;
/**
 *
 */
class ProfilesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Profile::truncate();

        Profile::create(array(
            'user_id'     	    => 1
        ));


    }
}