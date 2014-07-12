<?php
use Insight\Entities\Customer;
/**
 *
 */
class CustomersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Customer::truncate();

        Customer::create(array(
            'name'     	    => 'Emrill Services LLC.'
        ));
        Customer::create(array(
            'name'     	    => 'Chicago'
        ));
        Customer::create(array(
            'name'     	    => 'MAB'
        ));
        Customer::create(array(
            'name'     	    => 'Carillion Alawi'
        ));
        Customer::create(array(
            'name'     	    => 'ASD'
        ));
        Customer::create(array(
            'name'     	    => 'Khidmar'
        ));


    }
}