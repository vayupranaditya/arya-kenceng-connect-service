<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('phone_number', 12)
                ->unique();
            $table->string('name', 100);
            $table->string('profile_picture')
                ->nullable();
            $table->integer('jro_puri_id', 10);
            $table->integer('member_type', 1)
                ->comment('0: basic; 1: officer; 2: super user');
            $table->timestamps();

            $table->primary('phone_number');
            $table->foreign('phone_number')
                ->references('phone_number')
                ->on('users_detail')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('jro_puri_id')
                ->references('id')
                ->on('jro_puri')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
