<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->integer('sort');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('inst');
            $table->string('vk');
            $table->string('fb');
            $table->string('site');
            $table->string('img');
            $table->string('description');
            $table->string('cert');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('teachers');
    }
}
