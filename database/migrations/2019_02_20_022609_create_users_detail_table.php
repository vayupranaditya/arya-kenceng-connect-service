<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_detail', function(Blueprint $table)
		{
			$table->string('phone_number', 12)->primary();
			$table->date('birthdate');
			$table->boolean('is_male');
			$table->boolean('is_married');
			$table->string('current_address', 200);
			$table->string('job', 50);
			$table->string('business', 50);
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
		Schema::drop('users_detail');
	}

}
