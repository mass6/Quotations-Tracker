<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item_requests', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('customer_id');
            $table->string('reference')->nullable();
            $table->enum('status', array(
                'draft', 'assigned', 'completed','cancelled'
            ));
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('category_id');
            $table->string('estimated_volume')->nullable();
            $table->string('current_uom')->nullable();
            $table->float('current_price')->nullable();
            $table->text('attributes')->nullable();
            $table->text('notes')->nullable();
            $table->integer('created_by');
            $table->integer('assigned_to');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('item_requests');
	}

}
