<?php
use Insight\Entities\Quotation;
/**
 *
 */
class QuotationsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Quotation::truncate();

    }
}