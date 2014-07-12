<?php
use Insight\Entities\Attribute;
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
            'name'     	    => 'Material',
            'description'  	=> 'product material',
            'type'          => 'select',
            'values'        => '["Steel","Copper","Plastic","Wool"]',
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
        Attribute::create(array(
            'name'     	    => 'Environmental',
            'description'  	=> 'Is the product environmentally friendly? (i.e. "Green")',
            'type'          => 'boolean',
        ));
        Attribute::create(array(
            'name'     	    => 'BTUs',
            'description'  	=> 'BTU rating',
            'type'          => 'text'
        ));
        Attribute::create(array(
            'name'     	    => 'Embossing',
            'description'  	=> 'Embossing type',
            'type'          => 'select',
            'values'        => '["None","Embossed","Print"]'
        ));
    }
}