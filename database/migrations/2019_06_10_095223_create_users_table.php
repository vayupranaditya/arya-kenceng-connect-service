<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('phone_number', 12)->unique('phone_number_unique');
			$table->string('name', 100);
			$table->string('profile_pic_url')->nullable();
			$table->integer('jro_puri_id')->nullable()->index('users_jro_puri');
			$table->integer('member_type')->default(0)->comment('0: basic; 1: officer; 2: superuser');
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
		Schema::drop('users');
	}

}
