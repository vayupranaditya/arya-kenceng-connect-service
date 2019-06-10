<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->foreign('jro_puri_id', 'users_jro_puri')->references('id')->on('jro_puri')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id', 'users_users_detail')->references('user_id')->on('users_detail')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropForeign('users_jro_puri');
			$table->dropForeign('users_users_detail');
		});
	}

}
