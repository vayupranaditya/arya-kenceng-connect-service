<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_detail', function (Blueprint $table) {
            $table->string('phone_number', 12)
                ->unique();
            $table->date('birthdate')
                ->nullable();
            $table->boolean('is_male')
                ->nullable();
            $table->boolean('is_married')
                ->nullable();
            $table->string('current_address', 200)
                ->nullable();
            $table->string('job')
                ->nullable();
            $table->string('business')
                ->nullable();
            $table->timestamps();

            $table->primary('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_detail');
    }
}
