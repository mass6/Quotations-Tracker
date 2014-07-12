<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDateAssignedToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('item_requests', function(Blueprint $table)
		{
            $table->date('date_assigned')->after('assigned_to')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('item_requests', function(Blueprint $table)
		{
            $table->dropColumn('date_assigned');
		});
	}

}
