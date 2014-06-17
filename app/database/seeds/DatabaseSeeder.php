<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('GroupsTableSeeder');
		$this->call('UsersTableSeeder');
        $this->call('CustomersTableSeeder');
        $this->call('SuppliersTableSeeder');
        $this->call('CategoriesTableSeeder');
        $this->call('AttributesTableSeeder');
        $this->call('ItemRequestsTableSeeder');
	}

}
