<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePromoUsageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('promo_usage', function(Blueprint $table)
		{
			$table->string('user_id', 12);
			$table->integer('promo_id')->index('promo_usage_promo');
			$table->boolean('status')->default(1)->comment('0: used; 1: ready to redeem');
			$table->timestamps();
			$table->primary(['user_id','promo_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('promo_usage');
	}

}
