<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mk', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->dateTime('date_time');
            $table->integer('id_img');
            $table->integer('id_teacher');
            $table->integer('id_price');
            $table->boolean('sms')->default(0);
            $table->boolean('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mk');
    }
}
