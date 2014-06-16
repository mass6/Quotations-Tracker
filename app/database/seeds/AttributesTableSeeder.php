<?php

/**
 *
 */
class AttributesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Attribute::truncate();

        Attribute::create(array(
            'name'     	    => 'UOM',
            'description'  	=> 'Unit of measure the product is sold in',
            'type'          => 'text',
        ));
        Attribute::create(array(
            'name'     	    => 'Packaging',
            'description'  	=> 'How is the product packed',
            'type'          => 'text',
        ));
        Attribute::create(array(
            'name'     	    => 'Delivery',
            'description'  	=> 'Delivery options',
            'type'          => 'textarea',
        ));
        Attribute::create(array(
            'name'     	    => 'Environmental',
            'description'  	=> 'Is the product environmentally friendly? (i.e. "Green")',
            'type'          => 'boolean',
        ));
        Attribute::create(array(
            'name'     	    => 'Color',
            'description'  	=> 'Color of the product',
            'type'          => 'select',
            'values'        => '["White","Natural","Black","Red","Green","Blue","Yellow"]',
        ));
        Attribute::create(array(
            'name'     	    => 'BICS',
            'description'  	=> 'BICS color code',
            'type'          => 'select',
            'values'        => '["White","Green","Yellow","Red","N/A"]',
        ));

    }
}