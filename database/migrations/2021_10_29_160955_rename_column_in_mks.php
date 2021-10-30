<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnInMks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mks', function (Blueprint $table) {
            $table->renameColumn('id_pic', 'pic_id');
            $table->renameColumn('id_price', 'price_id');
            $table->renameColumn('id_teacher', 'teacher_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mks', function (Blueprint $table) {
            //
        });
    }
}
