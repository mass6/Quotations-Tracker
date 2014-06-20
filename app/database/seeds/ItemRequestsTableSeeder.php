<?php

/**
 *
 */
class ItemRequestsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ItemRequest::truncate();

        ItemRequest::create(array(
            'customer_id'   => 1,
            'reference'  	=> 'EMR-20140602',
            'status'        => 'assigned',
            'name'          => 'Stapler',
            'description'   => 'Type B standard metal stapler.',
            'category_id'   => 6,
            'estimated_volume'   => '50 pieces/month',
            'current_uom'   => 'each',
            'current_price'   => 2.50,
            'attributes'    => '["Color","Style"]',
            'created_by'   => 3,
            'assigned_to'   => 1
        ));
        ItemRequest::create(array(
            'customer_id'   => 2,
            'reference'  	=> 'CHI-20140610',
            'status'        => 'draft',
            'name'          => 'Cement',
            'description'   => '20lb sack of standard cement',
            'category_id'   => 3,
            'estimated_volume'   => '3000 lbs month',
            'current_uom'   => 'each',
            'current_price'   => 25.75,
            'attributes'    => '["BICS","Concentration"]',
            'created_by'   => 1,
            'assigned_to'   => 1
        ));
        ItemRequest::create(array(
            'customer_id'   => 3,
            'reference'  	=> 'MAB-20140421',
            'status'        => 'assigned',
            'name'          => 'Interfold paper',
            'description'   => '1 PLY 150SHT 20x23CM',
            'category_id'   => 5,
            'estimated_volume'   => '1500 cartons/month',
            'current_uom'   => 'carton',
            'current_price'   => 45.00,
            'attributes'    => '["Color","Paint Type","Interior/Exterior"]',
            'created_by'   => 1,
            'assigned_to'   => 1
        ));

    }
}