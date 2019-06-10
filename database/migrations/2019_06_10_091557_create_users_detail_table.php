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
			$table->integer('user_id')->unsigned()->primary();
			$table->date('birthdate')->nullable();
			$table->boolean('is_male')->nullable();
			$table->boolean('is_married')->nullable();
			$table->string('current_address', 200)->nullable();
			$table->string('job', 50)->nullable();
			$table->string('business', 50)->nullable();
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
