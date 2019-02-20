<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPromoUsageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('promo_usage', function(Blueprint $table)
		{
			$table->foreign('promo_id', 'promo_usage_promo')->references('id')->on('promo')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id', 'promo_usage_users')->references('phone_number')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('promo_usage', function(Blueprint $table)
		{
			$table->dropForeign('promo_usage_promo');
			$table->dropForeign('promo_usage_users');
		});
	}

}
