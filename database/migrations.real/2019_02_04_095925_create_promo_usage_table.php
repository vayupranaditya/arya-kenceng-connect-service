<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoUsageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_usage', function (Blueprint $table) {
            $table->string('user_id', 12);
            $table->integer('promo_id', 10)
                ->unsigned();
            $table->integer('status', 1)
                ->comment('0: used; 1: ready to redeem;');
            $table->timestamps();

            $table->primary([
                'user_id',
                'promo_id',
            ]);
            $table->foreign('user_id')
                ->references('phone_number')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('promo_id')
                ->references('id')
                ->on('promo')
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
        Schema::dropIfExists('promo_usage');
    }
}
