<?php
use Insight\Entities\Category;
/**
 *
 */
class CategoriesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Category::truncate();

        Category::create(array(
            'name'     	    => 'Uncategorized',
            'description'  	=> 'uncategorized'
        ));

        Category::create(array(
            'name'     	    => 'MEP',
            'description'  	=> 'MEP products'
        ));

        Category::create(array(
            'name'     	    => 'Construction',
            'description'  	=> 'Construction materials'
        ));

        Category::create(array(
            'name'     	    => 'Chemicals',
            'description'  	=> 'Chemical products'
        ));

        Category::create(array(
            'name'     	    => 'Paper',
            'description'  	=> 'Paper products'
        ));

        Category::create(array(
            'name'     	    => 'Plasic Bags',
            'description'  	=> 'Plastic bags'
        ));

        Category::create(array(
            'name'     	    => 'Cleaning',
            'description'  	=> 'Cleaning materials and supplies'
        ));

        Category::create(array(
            'name'     	    => 'Stationery',
            'description'  	=> 'Stationery and office supplies'
        ));

    }
}