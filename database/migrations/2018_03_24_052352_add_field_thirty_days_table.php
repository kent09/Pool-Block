<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldThirtyDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thirty_days', function (Blueprint $table) {
            $table->integer('block_height');
            $table->integer('current_height');
            $table->string('hash');
            $table->integer('size');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thirty_days', function (Blueprint $table) {
            $table->dropColumn('block_height');
            $table->dropColumn('current_height');
            $table->dropColumn('hash');
            $table->dropColumn('size');
        });
    }
}
