<?php

/**
 *
 */
class SuppliersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Supplier::truncate();

        Supplier::create(array(
            'name'     	    => '36S'
        ));
        Supplier::create(array(
            'name'     	    => 'Galaxy'
        ));
        Supplier::create(array(
            'name'     	    => 'Clean Globe'
        ));
        Supplier::create(array(
            'name'     	    => 'Mirdiff Trading LLC.'
        ));



    }
}