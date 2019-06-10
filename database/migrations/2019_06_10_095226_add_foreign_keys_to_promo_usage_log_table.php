<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPromoUsageLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('promo_usage_log', function(Blueprint $table)
		{
			$table->foreign('promo_id', 'FK_promo_usage_promo')->references('id')->on('promo')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id', 'FK_promo_usage_users')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('promo_usage_log', function(Blueprint $table)
		{
			$table->dropForeign('FK_promo_usage_promo');
			$table->dropForeign('FK_promo_usage_users');
		});
	}

}
