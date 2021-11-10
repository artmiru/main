<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonements', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->decimal('hour');
            $table->integer('payment_id');
            $table->integer('discount_id');
            $table->integer('admin_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('hold_date');
            $table->text('comments');
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
        Schema::dropIfExists('abonements');
    }
}
