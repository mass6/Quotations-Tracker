<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quotations', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->enum('status', array('draft', 'submitted', 'valid', 'expired'));
			$table->integer('created_by');
			$table->string('product_name');
			$table->string('product_code')->nullable();
			$table->integer('supplier_id');
			$table->text('product_description')->nullable();
			$table->text('attributes')->nullable();
			$table->text('attribute_values')->nullable();
			$table->string('uom');
			$table->float('uom_price');
			$table->string('packaging')->nullable();
			$table->float('pack_price')->nullable();
			$table->string('min_qty')->nullable();
			$table->text('delivery_notes')->nullable();
			$table->date('valid_until');
			$table->text('notes')->nullable();
			$table->softDeletes();
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
		Schema::drop('quotations');
	}

}